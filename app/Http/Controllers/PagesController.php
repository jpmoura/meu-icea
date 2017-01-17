<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PagesController extends Controller
{
    /**
     * Renderiza a página inicial do sistema.
     */
    public function home()
    {
        return view('inicio');
    }

    /**
     * Renderiza a view contento informações sobre o sistema.
     */
    public function sobre()
    {
        return view('sobre');
    }

    /**
     * Realiza o login automático do sistema de reserva.
     */
    public function reserva()
    {

        $encrypter = new Encrypter(Config::get('reserva.chave'), Config::get('reserva.algoritmo'));
        $id = $encrypter->encrypt(Auth::id());

        $httpClient = new Client();
        try
        {
            $response = $httpClient->request(Config::get('reserva.tokenGenerateRequestMethod'), Config::get('reserva.tokenGenerateUrl'), [
                "headers" => [
                    "Meu-ICEA" => $id,
                ],
            ]);
        }
        catch (ClientException $ex) { // Erros relacionados ao cliente
            return redirect()->back()->withErrors(['client' => $ex->getResponse()->getBody()->getContents()]);
        }
        catch (RequestException $ex) { // Erros relacionados ao servidor
            return redirect()->back()->withErrors(['server' => $ex->getResponse()->getBody()->getContents()]);
        }

        $body = $response->getBody()->getContents(); // Obtém o corpo da resposta

        if($body == 'quadro') $redirection = Config::get('reserva.quadroUrl'); // Redireciona para a seleção do quadro
        else $redirection = Config::get('reserva.tokenLoginUrl') . $body; // Redireciona para a url de login via token

        return redirect()->away($redirection);
    }

    /**
     * Redireciona para o sistena de chamados de suporte.
     */
    public function sisnti()
    {
        return redirect()->away(Config::get('sisnti.url'));
    }
}