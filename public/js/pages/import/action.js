$('.import-photo').click(function() {
    const import_button = $(this);
    const photo_id      = $(this).attr('id');
    const image_url     = $(`#photo-wrapper-${photo_id}`).find('img').attr('src');
    const title         = $(`#photo-wrapper-${photo_id}`).find('.title').text();
    const created_date  = $(`#photo-wrapper-${photo_id}`).find('.sub-title').text();

    if(!photo_id) 
        return;

    const data = {  
                    id: photo_id,
                    url: image_url, 
                    title: title, 
                    created_date: created_date,
                    type: 'photo',
                    _token : csrf_token 
    };
    $(this).find('.spinner-grow').removeClass('d-none');
    $(this).addClass('disabled');
    
    $.post( siteUrl + '/import-facebook/facebook', data, function(response) {
        // Log the response to the console
        import_button.addClass('disabled');
        import_button.removeClass('import-photo');
        import_button.removeAttr('id');
        import_button.find('.spinner-grow').addClass('d-none');
        import_button.text('Imported');

    }).fail(function(error) {
        import_button.find('.spinner-grow').addClass('d-none');
        import_button.removeClass('disabled');
    });
});

$('.import-video').click(function() {
    const import_button = $(this);
    const video_id      = $(this).attr('id');
    const video_url     = $(`#video-wrapper-${video_id}`).find('.video-link').attr('href');
    const thumbnail_url = $(`#video-wrapper-${video_id}`).find('.video-thumbnail').attr('src');
    const duration      = $(`#video-wrapper-${video_id}`).find('.video-duration').text();
    const created_date  = $(`#video-wrapper-${video_id}`).find('.title').text();

    if(!video_id) 
        return;

    const data = {  
                    id: video_id,
                    url: video_url,
                    thumbnail: thumbnail_url, 
                    duration: duration, 
                    created_date: created_date,
                    type: 'video',
                    _token : csrf_token 
    };
    
    $(this).find('.spinner-grow').removeClass('d-none');
    $(this).addClass('disabled');

    $.post( siteUrl + '/import-facebook/facebook', data, function(response) {
        // Log the response to the console
        import_button.removeClass('import-video');
        import_button.removeAttr('id');
        import_button.find('.spinner-grow').addClass('d-none');
        import_button.text('Imported');

    }).fail(function(error) {
        import_button.find('.spinner-grow').addClass('d-none');
        import_button.removeClass('disabled');
    });
});