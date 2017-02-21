<?php

namespace App\Http\Controllers\Auth;

use App\Events\LdapiErrorOnLogin;
use App\Events\LoginFailed;
use App\Events\NewUserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Usuario;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Renderiza a view de login
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Realuza o processo de login do usuário
     *
     * @param LoginRequest $request Requisição com os campos validados
     */
    public function postLogin(LoginRequest $request) {
        $input = $request->all();

        // Retirada dos pontos e hífen do CPF
        $input['username'] = str_replace('.', '', $input['username']);
        $input['username'] = str_replace('-', '', $input['username']);

        // Componentes do corpo da requisição
        $requestBody['user'] = $input['username'];
        $requestBody['password'] = $input['password'];
        $requestBody['attributes'] = ["cpf", "nomecompleto", "email", "id_grupo", "grupo"]; // Atributos que devem ser retornados em caso autenticação confirmada

        // Chamada de autenticação para a LDAPI
        $httpClient = new Client(['verify' => false]);
        try
        {
            $response = $httpClient->request(config('ldapi.requestMethod'), config('ldapi.authUrl'), [
                "auth" => [config('ldapi.user'), config('ldapi.password'), "Basic"],
                "body" => json_encode($requestBody),
                "headers" => [
                    "Content-type" => "application/json",
                ],
            ]);
        }
        catch (ClientException $ex) { // Erros relacionados a autenticação
            $credentials['username'] = $input["username"];
            $credentials['password'] = $input['password'];

            event(new LoginFailed($credentials)); // Dispara um evento de falha de login

            return redirect()->back()->withErrors(['credentials' => $ex->getMessage()]);
        }
        catch (RequestException $ex) { // Erros relacionados ao servidor
            $credentials['username'] = $input["username"];
            $credentials['password'] = $input['password'];

            event(new LdapiErrorOnLogin($credentials)); // Dispara um evento de falha de login

            return redirect()->back()->withErrors(['server' => $ex->getMessage()]);
        }

        // Se nenhuma excessão foi jogada, então o usuário está autenticado
        $user = Usuario::where('cpf', $input['username'])->first();

        // Se o usuário é NULL então ou ele não é cadastrado no sistema
        if(is_null($user))
        {
            // Recupera os atributos retornados pelo servidor de autenticação
            $userData = json_decode($response->getBody()->getContents());

            $user = Usuario::create([
                'cpf' => $userData->cpf,
                'email' => $userData->email,
                'id_grupo' => $userData->id_grupo,
                'grupo' => $userData->grupo,
                'nome' => ucwords(strtolower($userData->nomecompleto)),
            ]);

            // Disparo do evento de novo usuário criado
            event(new NewUserCreated($user));
        }

        // Se o usuário selecionou a opção de ser lembrado,
        if(isset($input['remember-me'])) auth()->login($user, true); // Então ele deve ser lembrado
        else auth()->login($user); // Senão é um login ordinário

        // Redireciona para a página pretendida ou para a página inicial do sistema
        return redirect()->intended('/');
    }
}
