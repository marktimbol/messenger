<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $message;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function threads()
    {
        return $this->hasMany(Thread::class, 'from', 'to');
    }

    public function send(Message $message)
    {
        $this->message = $message;
        return $this;
    }

    public function toUser(User $user)
    {                
        // $message = new Message([
        //     'from'    => auth()->user()->id,
        //     'to'    => $user->id,
        //     'body'  => $this->message->body
        // ]);

        $thread = Thread::create([
            'from'    => $this->id,
            'to'    => $user->id,
            'body'  => $this->message->body
        ]);

        Reply::create([
            'thread_id' => $thread->id,
            'from'  => $this->id,
            'to'    => $user->id,
            'body'  => $this->message->body
        ]);

    }
}
