<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Notifications\UserFollowed;
use App\Notifications\UserFriendReaction;
use Hootlex\Friendships\Status;

class FriendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.friend.index');
    }

    /**
     * Search friends.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        $data = [
            'users' => $users
        ];
        return view('pages.friend.search')->with($data);
    }

    /**
     * Add friend
     *
     * @return Response
     */
    public function addFriend(Request $request)
    {
        $userId = $request->input('user_id');

        $user = Auth::user();
        $recipient = User::find($userId);

        if ($user->canSendFriendRequest($recipient)) {
            $recipient->notify(new UserFollowed($user));

            $user->befriend($recipient);
            
            return response()->json([
                'message' => 'success',
            ]);
        }
        
        return response()->json([
            'message' => 'failed',
        ]);
    }

    /**
     * Get count of unread friend-request notifications
     *
     * @param Request $request
     * @return Response
     */
    public function getUnReadFollowCount(Request $request)
    {
        $user = Auth::user();
        $count = $user->unreadNotifications()
                    ->where('type', 'App\\Notifications\\UserFollowed')
                    ->get()
                    ->count();

        return response()->json([
            'count' => $count,
        ]);
    }

    /**
     * Get count of unread friend-request notifications
     *
     * @param Request $request
     * @return Response
     */
    public function getUnReadNotificationCount(Request $request)
    {
        $user = Auth::user();
        $count = $user->unreadNotifications()
                    ->where('type','!=' ,'App\\Notifications\\UserFollowed')
                    ->get()
                    ->count();

        return response()->json([
            'count' => $count,
        ]);
    }

    /**
     * Mark as read follow notification
     *
     * @param Request $request
     * @return Response
     */
    public function markAsReadFollowNotification(Request $request)
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications()->where('type', 'App\\Notifications\\UserFollowed')->get();

        foreach ($notifications as $notify) {
            $notify->markAsRead();
        }

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Mark as read follow notification
     *
     * @param Request $request
     * @return Response
     */
    public function markAsReadOtherNotification(Request $request)
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications()->where('type' ,'!=' ,'App\\Notifications\\UserFollowed')->get();

        foreach ($notifications as $notify) {
            $notify->markAsRead();
        }

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Accept Friend
     *
     * @param Request $request
     * @return Response
     */
    public function acceptFriendRequest(Request $request)
    {
        $userId = $request->input('user_id');

        $user = Auth::user();
        $sender = User::find($userId);

        // Accept Friend Request
        $user->acceptFriendRequest($sender);

        // Send accepted notification to follower
        $message = $this->generateMessage($user->fullName(), Status::ACCEPTED);
        $sender->notify(new UserFriendReaction($user, $message));

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Deny Friend
     *
     * @param Request $request
     * @return Response
     */
    public function denyFriendRequest(Request $request)
    {
        $userId = $request->input('user_id');

        $user = Auth::user();
        $sender = User::find($userId);

        $user->denyFriendRequest($sender);

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Block Friend
     *
     * @param Request $request
     * @return Response
     */
    public function blockFriend(Request $request)
    {
        $userId = $request->input('user_id');

        $user = Auth::user();
        $sender = User::find($userId);

        $user->blockFriend($sender);

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove Friend from Friendlists
     *
     * @param Request $request
     * @return Response
     */
    public function removeFriend(Request $request)
    {
        $userId = $request->input('user_id');

        $user = Auth::user();
        $friend = User::find($userId);

        $user->unfriend($friend);

        return response()->json([
            'message' => 'success',
        ]);
    }

    protected function generateMessage($recipientName, $status) {

        if ($status == Status::ACCEPTED)
            return $recipientName.' has accepted your friend request';
        else if ($status == Status::DENIED)
            return $recipientName.' has denied your friend request';
        else if ($status == Status::BLOCKED)
            return $recipientName.' has blocked your friend request';
    }
}
