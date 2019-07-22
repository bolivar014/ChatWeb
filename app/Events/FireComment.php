<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FireComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    public $user;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        // Incializamos el comentario con sus objetos para extraer los datos necesarios...
        $this->comment = $comment;
        $this->user = Auth()->user();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Envia datos de ID del comentario
        return new PrivateChannel('coments.'.$this->comment->post_id);
    }
}
