<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use DB;
use Session;
use Input;
use Log;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
  public function hexToStr($hex) {
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i+=2) {
      $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
  }

  public function encodePassword($raw) {
    $password = base64_encode($this->hexToStr(md5($raw)));
    return $password;
  }

  public function isPasswordValid($encoded, $raw) {
    $password = base64_encode($this->hexToStr(md5($raw)));
    return $password == $encoded;
  }


  /**
  * Retorna o nível de privilégio do usuário, caso ele tenha algum
  * senão retorna 0 e o acesso é proibido
  */
  public function permitted($local)
  {
    // Verifica se o usuário pertence a localidade de João Monlevade

    if($local == 'JM') return true;
    else return false;

    // Grupos do ICEA
    //  switch ($group) {
    //    case 712:   // Biblioteca
    //    case 714:   // ICEA
    //    case 715:   // DECEA
    //    case 716:   // DEENP
    //    case 7213:  // Eng. Computação
    //    case 7215:  // Eng. Produção JM
    //    case 7217:  // Eng. Elétrica
    //    case 7126:  // DECOM - Ouro Preto
    //    case 7236:  // Sistemas Informação
    //    case 71130: // DECSI
    //    case 71481: // DEELT
    //      return true;
    //      break;
    //    default:
    //      return false;
    //      break;
    //  }

  }

  // Encrypt Function
  static function mc_encrypt($encrypt) {
  	$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
  	$passcrypt = trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, env('APP_ENC_KEY'), trim($encrypt), MCRYPT_MODE_ECB, $iv));
  	$encode = base64_encode($passcrypt);
  	return $encode;
  }

  // Decrypt Function
  static function mc_decrypt($decrypt) {
  	$decoded = base64_decode($decrypt);
  	$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
  	$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, env('APP_ENC_KEY'), trim($decoded), MCRYPT_MODE_ECB, $iv));
  	return $decrypted;
  }

  public static function checkLogin()
  {
    if(Session::has('id')) {
      $realID = UserController::mc_decrypt(base64_decode(Session::get('id')));
      $hasSession = DB::table('sessions')->select('id')->where('id', $realID)->first();

      if(is_null($hasSession)) {
        Session::flush();
        return false;
      }
      else return true;

    }
    else return false;
  }

  public function doLogin()
  {
    if($this->checkLogin()) return Redirect::route("home");
    else {
      $ldap = DB::table('ldap')->select()->first();
      $ds = ldap_connect($ldap->server); // Ip servidor ldap
      $bind = ldap_bind($ds, $ldap->user . ',' . $ldap->domain, $ldap->password); // conexão, usuário leitor, senha
      if($bind) {
        $login = Input::get("login");

        // filtrar pelo login, que é o CPF
        $filter = "(" . 'uid' . "=" . $login . ")"; // filtrar pelo login, que é o CPF

        // Atributos a serem recuperados, CPF, Primeiro Nome, Sobrenome. e-mail, grupo, local, telefones, senha e número do grupo
        $justthese = array('uid', 'cn', 'sn', 'mail', 'OU', 'o', 'telephoneNumber', 'userPassword', 'gidNumber');

        // Procurar na conexão LDAP, no dominio dc=ufop,dc=br usando o filtro de CPF e retornando somente as informações desejadas
        $sr = ldap_search($ds, 'dc=ufop,dc=br', $filter, $justthese);

        // Recuperar todas as entradas encontradas, que no caso deve ser só uma
        $entry = ldap_get_entries($ds, $sr);
        if ($entry['count'] > 0) { // Se o número de entradas encontradas for maio que 0, então encontrou o usuário

          // Verificar se a senha informada no login é a mesma no LDAP
          // A senha do LDAP é um md5 da senha bruta do usuário, que depois é convertida em hexadecimal e então codificada em base 64
          // processo da senha: senha bruta => MD5 => Hexadecimal => base64

          // Verifica se o usuário tem permissão de acesso no sistema
          $authorized = $this->permitted($entry[0]['o'][0]);

          if(!$authorized) {
            // Se ele não tiver, retorna erro
            $mensagem = "Você não tem permissão de acesso ao sistema.";
            $erro = 1;
            $input = "";
          }

          // Se a senha é válida e ele pertence ao grupo do ICEA no LDAP, então está autenticado
          else if($this->isPasswordValid(substr($entry[0]['userpassword'][0], 5), Input::get("senha"))) {

            //verificar se já não existe no banco o cpf do usuário, que denota uma sessão ativa
            $encryptedUid = $this->mc_encrypt($entry[0]['uid'][0]);

            $hasId = DB::table('sessions')->select('id')->where('uid', $encryptedUid)->first();

            // Se é nula então podemos adicionar uma nova sessão no banco
            if(is_null($hasId)) {
              // adicionar encryptado no banco
              $id = DB::table('sessions')->insertGetId
              ([
                'uid' => $this->mc_encrypt($entry[0]['uid'][0]),
                'cn' => $this->mc_encrypt($entry[0]['cn'][0]),
                'sn' => $this->mc_encrypt($entry[0]['sn'][0]),
                'mail' => $this->mc_encrypt($entry[0]['mail'][0]),
                'ou' => $this->mc_encrypt($entry[0]['ou'][0]),
                'o' => $this->mc_encrypt($entry[0]['o'][0]),
                'telephonenumber' => $this->mc_encrypt($entry[0]['telephonenumber'][0]),
                'gidnumber' => $this->mc_encrypt($entry[0]['gidnumber'][0])
              ]);
            }
            else $id = $hasId->id;

            $id = base64_encode($this->mc_encrypt($id));
            Session::put('id', $id);
            Log::info("Usuário com ID " . $entry[0]['uid'][0] . " e nome " . $entry[0]['cn'][0] . $entry[0]['sn'][0] . " entrou no sistema.");

            return Redirect::route("home");
          }
          else {
            $mensagem = "A senha está incorreta!";
            $erro = 2;
            $input = Input::get('login');
          }
        }
        else {
          $erro = 1;
          $mensagem = "O usuário não existe";
          $input = "";
        }
        ldap_unbind($ds);
      }
      else {
        $erro = 1;
        $mensagem = "Impossível conectar ao servidor de autenticação";
        $input = "";
      }

      Session::flash("erro", $erro);
      Session::flash("mensagem", $mensagem);
      return Redirect::back()->withInput(["login" => $input]);
    }
  }

  public function doLogout()
  {
    if($this->checkLogin()) {
      $id = $this->mc_decrypt(base64_decode(Session::get('id')));
      DB::table('sessions')->where('id', $id)->delete();
      Log::info("Usuário com ID " . Session::get("id") . " saiu do sistema.");
      Session::flush();
      return Redirect::route("getLogin")->with("mensagem", "Você foi desconectado com sucesso.");
    }
    else return Redirect::route("getLogin");
  }
}
