<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Encryption\Encrypter;

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

        $encrypter = new Encrypter(config('reserva.chave'), config('reserva.algoritmo'));
        $id = $encrypter->encrypt(auth()->id());

        $httpClient = new Client(['verify' => false]);
        try
        {
            $response = $httpClient->request(config('reserva.tokenGenerateRequestMethod'), config('reserva.tokenGenerateUrl'), [
                "headers" => [
                    "Meu-ICEA" => $id,
                ],
            ]);
        }
        catch (ClientException $ex)
        { // Erros relacionados ao cliente
            return redirect()->back()->withErrors(['client' => $ex->getResponse()->getBody()->getContents()]);
        }
        catch (RequestException $ex)
        { // Erros relacionados ao servidor
            return redirect()->back()->withErrors(['server' => $ex->getMessage()]);
        }

        $body = $response->getBody()->getContents(); // Obtém o corpo da resposta

        if($body == 'quadro') $redirection = config('reserva.quadroUrl'); // Redireciona para a seleção do quadro
        else $redirection = config('reserva.tokenLoginUrl') . $body; // Redireciona para a url de login via token

        return redirect()->away($redirection);
    }

    /**
     * Redireciona para o sistena de chamados de suporte.
     */
    public function sisnti()
    {
        return redirect()->away(config('sisnti.url'));
    }
}
