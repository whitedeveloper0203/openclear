<?php

function alreadyImported($user, $media_id) 
{   
    $media = $user->medias()->where('file_id', $media_id)->get();
    return $media->count() > 0 ? true : false;
}