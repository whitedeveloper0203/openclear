const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
    notification: 'App\\Notifications\\UserFriendReaction',
};

$(document).ready(function() {
    if(userId) {
        //...
        Echo.private(`App.User.${userId}`)
            .notification((notification) => {
                makeNotification(notification);
        });
    }

    function makeNotification(notification) {
        var htmlElements = '';

        if (notification.type == NOTIFICATION_TYPES.follow) {
            htmlElements = makeFriendRequestHtml(notification.data);
            refreshUnReadCount(notification.type);
            $('#notification-friend-requeset').prepend(htmlElements);
        }
        else if (notification.type == NOTIFICATION_TYPES.notification) {
            htmlElements = makeNotificationHtml(notification.data);
            refreshUnReadCount(notification.type);
            $('#notification-other-requeset').prepend(htmlElements);
        }
    }

    function refreshUnReadCount(type) {
        if (type == NOTIFICATION_TYPES.follow) {
            updateUnReadFriendlistAlert();    
        }
        else if (type == NOTIFICATION_TYPES.notification) {
            updateUnReadOtherNotification();
        }
    }

    function updateUnReadFriendlistAlert() {
        $.ajax({
            type: "GET",
            url: siteUrl + "/notification/unread-friendlist-count",
            success:function(res){               
                if(res){
                    var element = $('#unread-count-friendrequest');
                    element.text(res.count);
                    if (res.count > 0)
                        element.removeClass('d-none');
                    else
                        element.addClass('d-none');    
                }
            }
        });
    }

    function updateUnReadOtherNotification() {
        $.ajax({
            type: "GET",
            url: siteUrl + "/notification/unread-notification-count",
            success:function(res){               
                if(res){
                    var element = $('#other-notification-count');
                    element.text(res.count);
                    if (res.count > 0)
                        element.removeClass('d-none');
                    else
                        element.addClass('d-none');    
                }
            }
        });
    }

    function makeFriendRequestHtml(data) {
        return `<li class="notification-item">
                    <div class="author-thumb">
                        <img src="${data.follower_avatar}" alt="author">
                    </div>
                    <div class="notification-event">
                        <a href="#" class="h6 notification-friend">${data.follower_name}</a>
                    </div>
                    <span class="notification-icon">
                        <a href="javascript:void(0)" class="accept-request request-acc" value="${data.follower_id}">
                            Accept
                        </a>

                        <a href="javascript:void(0)" class="accept-request request-del" value="${data.follower_id}">
                            Deny
                        </a>
                    </span>
                </li>`;
    }

    function makeNotificationHtml(data) {
        return `<li>
                    <div class="author-thumb">
                        <img src="${data['sender_avatar']}" alt="author">
                    </div>
                    <div class="notification-event">
                        <div><a href="#" class="h6 notification-friend">${data['message']}</a>
                    </div>
                </li>`;
    }

    // Remove notification alerts if user enter mouse on the notification icon
    $('#icon-friendlist-notification').mouseenter(function(){
        if ($("#unread-count-friendrequest").text() != "0") {
            $.ajax({
                type: "GET",
                url: siteUrl + "/notification/mark-as-read-friendlist",
                success:function(res){               
                    if (res.message == 'success'){
                        updateUnReadFriendlistAlert();
                    }
                }
            });
        }
    });

    $('#icon-other-notification').mouseenter(function(){
        if ($("#other-notification-count").text() != "0") {
            $.ajax({
                type: "GET",
                url: siteUrl + "/notification/mark-as-read-notification",
                success:function(res){               
                    if (res.message == 'success'){
                        updateUnReadOtherNotification();
                    }
                }
            });
        }
    });

    // Accept friend on header notification
    $('#notification-friend-requeset').delegate('.request-acc', 'click', function(){
        const element = $(this);
        const user_id = element.attr('value');

        const data = {  
            user_id: user_id,
            _token : csrf_token 
        };
    
        $.post( siteUrl + '/friends/accept-friend', data, function(response) {
            // Log the response to the console
            if (response.message == 'success') {
                const parent = element.parent();
                
                element.remove();
                parent.find('.request-del').remove();
                parent.append('<span class="text-secondary">Accepted</span>');
            }

        }).fail(function(error) {
            alert("Error!");
        });
    });

    // Deny friend on header notification
    $('#notification-friend-requeset').delegate('.request-del', 'click', function(){
        const element = $(this);
        const user_id = element.attr('value');

        const data = {  
            user_id: user_id,
            _token : csrf_token 
        };
    
        $.post( siteUrl + '/friends/deny-friend', data, function(response) {
            // Log the response to the console
            if (response.message == 'success') {
                const parent = element.parent();
                
                element.remove();
                parent.find('.request-acc').remove();
                parent.append('<span class="text-secondary">Denied</span>');
            }

        }).fail(function(error) {
            alert("Error!");
        });
    });
});