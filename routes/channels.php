<?php

use Illuminate\Support\Facades\Broadcast;
Broadcast::channel('user.{reciver}', function($user, $reciver) {
    return (int)$user->id === (int)$reciver;
});

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chatRoom',function ($user){
   return ['userObj' => $user];
   
});