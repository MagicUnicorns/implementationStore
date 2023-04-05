<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//dedicated channel for the user
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    //dd((int) $user->id === (int) $id);
    return (int) $user->id === (int) $id;
});

//Test channel
Broadcast::channel('notification', function () {
    return true;
});