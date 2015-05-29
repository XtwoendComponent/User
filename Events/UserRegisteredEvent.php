<?php namespace Xtwoend\Component\User\Events;

use Xtwoend\Component\User\Entities\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserRegisteredEvent implements ShouldBroadcast
{
    //use SerializesModels;
    public $user;
    
    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notification'];
    }
}