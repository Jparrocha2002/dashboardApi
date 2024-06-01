<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use App\Models\Comment;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public string $message;
    public $post_id;
    public function __construct(string $message, $post_id)
    {
        $this->message = $message;
        $this->post_id = $post_id;
    }
    public function broadcastOn()
    {
        return new Channel('public' . $this->post_id);
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}

// event(new MyEvent('hello world'));