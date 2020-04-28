<?php

use App\User;

function alreadyImported($user, $media_id) 
{   
    $media = $user->medias()->where('file_id', $media_id)->get();
    return $media->count() > 0 ? true : false;
}

function headerPhoto($user)
{
    $headerMedia = $user->medias()->where('type', 'header')->first();
    
    if ($headerMedia)
        return $headerMedia->url;

    return 'img/top-header1.jpg';
}

function profilePhoto($user)
{
    $headerMedia = $user->medias()->where('type', 'profile')->first();

    if ($headerMedia)
        return $headerMedia->url;

    return 'img/author-main1.jpg';
}


function localPhotos($user)
{
    $photos = $user->medias()->where('type', 'photo')->get();
    return $photos;
}

function unReadFriendRequest($user)
{
    return $user->unreadNotifications()
                ->where('type', 'App\\Notifications\\UserFollowed')
                ->get()
                ->toArray();
}

function lastFriendRequestNotification($user, $limit)
{   
    return $user->notifications()
                ->where('type', 'App\\Notifications\\UserFollowed')
                ->orderBy('created_at', 'DESC')
                ->take($limit)
                ->get()
                ->toArray();
    
}

function isSentFriendRequest($user, $sender_id)
{
    $sender = User::find($sender_id);
    return $user->hasFriendRequestFrom($sender);
}

function statusFriendshipTwoUser($user, $sender_id)
{
    $sender = User::find($sender_id);
    
    if ($user->isFriendWith($sender))
        return 'Accepted';
    else if ($user->hasBlocked($sender))
        return 'Blocked';
    else if ($user->hasDenied($sender))
        return 'Denied';

    return '';
}

function lastNotifications($user, $limit)
{   
    return $user->notifications()
                ->where('type', '!=' ,'App\\Notifications\\UserFollowed')
                ->orderBy('created_at', 'DESC')
                ->take($limit)
                ->get()
                ->toArray();
    
}

function unReadNotifications($user)
{
    return $user->unreadNotifications()
                ->where('type', '!=','App\\Notifications\\UserFollowed')
                ->get()
                ->toArray();
}

function generateNotificationMessage($data, $type)
{
    if ($type == 'App\Notifications\UserFollowed')
        return $data['follower_name'].' sent friend request';
    else if ($type == 'App\Notifications\UserFriendReaction')
        return $data['message'];
}

function generateAvatarNotification($data, $type)
{
    if ($type == 'App\Notifications\UserFollowed')
        return $data['follower_avatar'];
    else if ($type == 'App\Notifications\UserFriendReaction')
        return $data['sender_avatar'];
}