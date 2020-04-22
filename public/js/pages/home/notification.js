const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
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
        }
        $('#notification-friend-requeset').prepend(htmlElements);
    }

    function refreshUnReadCount(type) {
        if (type == NOTIFICATION_TYPES.follow) {
            updateUnReadFriendlistAlert();    
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

    function makeFriendRequestHtml(data) {
        return `<li>
                    <div class="author-thumb">
                        <img src="${data.follower_avatar}" alt="author">
                    </div>
                    <div class="notification-event">
                        <a href="#" class="h6 notification-friend">${data.follower_name}</a>
                    </div>
                    <span class="notification-icon">
                        <a href="#" class="accept-request">
                            <span class="icon-add without-text">
                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                            </span>
                        </a>

                        <a href="#" class="accept-request request-del">
                            <span class="icon-minus">
                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                            </span>
                        </a>

                    </span>
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
});