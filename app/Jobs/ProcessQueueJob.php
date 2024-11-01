<?php

namespace App\Jobs;

use App\Events\QueueCompleted; // Importar o evento
use App\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct($request)
    {
        $this->user = $request;
    }

    public function handle(UserRepository $userRepository)
    {
        $user = $userRepository->create([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => $this->user['email']
        ]);


        event(new QueueCompleted($user));

        Log::info("teste de job, user: $user");
        Log::info("mensagem enviada para o job, user: $user");

        echo "finalizado";
    }
}
