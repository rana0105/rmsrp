<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatRoomEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $currentChatRoomId;
    public $currentPortalId;
    public $filePath;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, User $user,$currentChatRoomId, $chatId)
    {
        $this->message = $message;
        $this->user = $user;
        $this->currentChatRoomId =  $currentChatRoomId;
        $this->currentPortalId =  Auth::user()->getPortal(Auth::user()->portalJoinUser_id);
        $this->filePath =  $chatId;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chatRoom');
    }
}
