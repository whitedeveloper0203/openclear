// $('.btn-add-friend').click(function() {
    
// });

$('.control-block-button').delegate('.btn-add-friend', 'click', function() {

    const element = $(this);

    user_id = $(this).attr('value');

    const data = {  
        user_id: user_id,
        _token : csrf_token 
    };

    $.post( siteUrl + '/friends/add-friend', data, function(response) {
        // Log the response to the console
        if (response.message == 'success') {
            element.removeClass('bg-blue');
            element.removeClass('btn-add-friend');
            element.addClass('bg-secondary');
        }
    }).fail(function(error) {
        
    });
});