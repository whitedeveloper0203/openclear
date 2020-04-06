<?php

function alreadyImported($user, $media_id) 
{   
    $media = $user->medias()->where('file_id', $media_id)->get();
    return $media->count() > 0 ? true : false;
}

function headerPhoto($user)
{
    try {
        $headerMedia = $user->medias()->where('type', 'header')->firstOrFail();
        return $headerMedia->url;
    } catch (ErrorException $e) {   
        return 'img/top-header1.jpg';
    }
}

function localPhotos($user)
{
    $photos = $user->medias()->where('type', 'photo')->get();
    return $photos;
}