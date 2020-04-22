$('.btn-add-friend').click(function() {
    
    user_id = $(this).attr('value');

    const data = {  
        user_id: user_id,
        _token : csrf_token 
    };

    $.post( siteUrl + '/friends/add-friend', data, function(response) {
        // Log the response to the console
        console.log(response);
    }).fail(function(error) {
        
    });
});