$('.google-friend-request').click(function() {
    const f_container = $(this).parent().find('.google-friend-container');
    const f_name = f_container.find('.friend-name').text();
    const f_email = f_container.find('.friend-email').text();
    
    const data = {  
        f_name: f_name,
        f_email: f_email,
        _token : csrf_token 
    };
    // $(this).find('.spinner-grow').removeClass('d-none');
    // $(this).addClass('disabled');

    $.post( siteUrl + '/import-google/friends-request', data, function(response) {
        // Log the response to the console
        // import_button.addClass('disabled');
        // import_button.removeClass('import-photo');
        // import_button.removeAttr('id');
        // import_button.find('.spinner-grow').addClass('d-none');
        // import_button.text('Imported');
        console.log(response);

    }).fail(function(error) {
        // import_button.find('.spinner-grow').addClass('d-none');
        // import_button.removeClass('disabled');
    });
});