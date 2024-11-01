<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SseController extends Controller
{
    public function stream()
    {
        $response = new StreamedResponse(function () {
            while (true) {
                // Aqui você pode verificar se a fila foi concluída
                // Por exemplo, se a fila terminou, você pode enviar uma notificação
                // Para simplificar, vamos enviar uma mensagem a cada 5 segundos
                echo "data: Processo finalizado!\n\n";
                ob_flush(); // Limpa o buffer de saída
                flush();    // Envia os dados para o cliente

                // Espera 5 segundos antes de enviar o próximo evento
                sleep(5);
            }
        });

        // Definir os cabeçalhos para SSE
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');

        return $response;
    }
}
