<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class QueueCompleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct($user)
    {

        $this->user = $user;
        Log::info("teste de evento, user: $user->id");
    }

    public function broadcastOn()
    {
        Log::info("teste de evento, canal");
        return new Channel('userCreated');
    }

    public function broadcastWith()
    {
        Log::info("mensagem enviada para o pusher, user:");
        return [
            'user' => $this->user,
            'message' => 'Usuário criado',
        ];
    }

    public function broadcastAs()
    {
        Log::info("mensagem enviada escolha de evento:");
        return 'created';
    }

}
