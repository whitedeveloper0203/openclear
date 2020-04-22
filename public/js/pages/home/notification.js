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
        }
        $('#notification-friend-requeset').prepend(htmlElements);
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
});