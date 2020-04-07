<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Media;

use Auth;
use Storage;
use Thumbnail;

class ImportController extends Controller
{
    public $fb;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fb = app(\Scottybo\LaravelFacebookSdk\LaravelFacebookSdk::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('pages.friend');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function facebook()
    {
        $user = Auth::user();

        try {
            $response = $this->fb->get('/me/photos/uploaded?fields=id,images,alt_text,created_time', $user->social_token);
            $photos = $response->getDecodedBody();

            $response = $this->fb->get('/me/videos/uploaded?fields=picture,permalink_url,title,source,length,created_time', $user->social_token);
            $videos = $response->getDecodedBody();

            $response = $this->fb->get('/me/friends?fields=address,about,email,last_name,birthday,first_name,gender,location,website,age_range,name', $user->social_token);
            $friends = $response->getDecodedBody();

            $response = $this->fb->get('/me/posts', $user->social_token);
            $posts = $response->getDecodedBody();

            $data = [
                'photos'    => $photos['data'],
                'videos'    => $videos['data'],
                'friends'   => $friends['data'],
                'posts'     => $posts['data'],
            ];
            return view('pages.import')->with($data);
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Import File From Facebook to GCP
     *
     * @param  Request  $request
     * @param  string  $service
     * @return Response
     */
    public function importFacebook(Request $request, $service)
    {
        $mediaId    = $request->input('id');
        $mediaUrl   = $request->input('url');
        $mediaTitle = $request->input('title');
        $mediaType  = $request->input('type');
        $duration   = $request->input('duration');
        $thumbnail  = $request->input('thumbnail');

        $url = $this->uploadToStorage($mediaUrl, $mediaId, $mediaType);

        $user = Auth::user();

        $media = new Media();
        $media->user_id     = $user->id;
        $media->url         = $url;
        $media->title       = $mediaTitle;
        $media->file_id     = $mediaId;
        $media->type        = $mediaType;
        $media->duration    = $duration;
        $media->thumbnail_url = $thumbnail;
        
        $media->save();

        return response()->json([
            'data' => $media,
        ]);
    }

    /**
     * Upload Media to Storage
     *
     * @param [string] $mediaUrl
     * @param [string] $mediaId
     * @param [string] $type
     * @return string
     */
    protected function uploadToStorage($mediaUrl, $mediaId, $type)
    {
        $prefix = '';
        $extension = '.';

        switch ($type) {
            case 'photo':
                $prefix     = 'photo/';
                $extension  .= 'jpg';
                break;
            case 'video':
                $prefix     = 'video/';
                $extension  .= 'mp4';
                break;
            default:
                $prefix = 'photo/';
                $extension  .= 'jpg';
                break;
        }

        $fileContents = file_get_contents($mediaUrl);
        $disk   = Storage::disk('gcs');
        $filePath = $prefix.$mediaId.$extension; 
        
        $disk->put($filePath, $fileContents);
        $url = $disk->url($filePath);

        return $url;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param string $type
     * @return void
     */
    public function importLocalMedia(Request $request, $type) 
    {
        $disk = Storage::disk('gcs');

        $mediaTitle = $request->input('title');
        $mediaFile = $request->file('file');
        $mediaId = '000'.rand();
        $new_name = $mediaId . '.' . $mediaFile->getClientOriginalExtension();
        
        // Move image to public/image
        $mediaFile->move(public_path('uploads'), $new_name);
        $publicMediaUrl = public_path('uploads/'.$new_name);
        
        // If media is video, we need to generate thumbnail
        $thumbnailName = $thumbnailUrl = '';    
        if ($type == 'video')
        {
            $thumbnailName = 'thu'.rand().".jpg";
            $thumbnailStatus = Thumbnail::getThumbnail($publicMediaUrl, public_path('uploads'), $thumbnailName, 0);

            if ($thumbnailStatus)
            {
                $publicThumbnailUrl = public_path('uploads/'.$thumbnailName);
                // Upload to GCP
                $filePath       = 'photo/'.$thumbnailName; 
                $fileContent    = file_get_contents($publicThumbnailUrl);

                $disk->put($filePath, $fileContent);
                $thumbnailUrl = $disk->url($filePath);

                @unlink($publicThumbnailUrl);
            }
        }
        // Upload to GCP
        $filePath       = $type.'/'.$new_name; 
        $fileContent    = file_get_contents($publicMediaUrl);

        $disk->put($filePath, $fileContent);
        $url = $disk->url($filePath);

        // Remove image in public/image
        @unlink($publicMediaUrl);

        $user = Auth::user();

        $media = new Media();
        $media->user_id     = $user->id;
        $media->file_id     = $mediaId;
        $media->url         = $url;
        $media->title       = $mediaTitle;
        $media->type        = $type;
        $media->thumbnail_url = $thumbnailUrl;
        
        $media->save();

        return response()->json([
            'message' => 'Media Uploaded Successfully',
            'data' => $media,
        ]);
    }

    /**
     * Import Header Photo function
     *
     * @param Request $request
     * @return void
     */
    public function importHeaderPhoto(Request $request)
    {
        $disk = Storage::disk('gcs');

        $mediaFile = $request->file('file');
        $type = $request->input('type');
        $mediaId = '000'.rand();
        $new_name = $mediaId . '.' . $mediaFile->getClientOriginalExtension();

        // Move image to public/image
        $mediaFile->move(public_path('uploads'), $new_name);
        $publicMediaUrl = public_path('uploads/'.$new_name);

        // Upload to GCP
        $filePath       = 'photo'.'/'.$new_name; 
        $fileContent    = file_get_contents($publicMediaUrl);

        $disk->put($filePath, $fileContent);
        $url = $disk->url($filePath);

        // Remove image in public/image
        @unlink($publicMediaUrl);

        $user = Auth::user();

        $media = Media::firstOrNew([
            'user_id'   => $user->id,
            'type'      => $type,
        ]);
        $media->url = $url;
        $media->file_id = $mediaId;
        $media->save();

        return response()->json([
            'message' => 'Media Uploaded Successfully',
            'data' => $media,
        ]);
    }
}
