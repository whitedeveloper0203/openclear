function readHomeURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#home-blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#home-file-photo-upload').change(function() {
    readHomeURL(this);
    $('.home-photo-preview-container').removeClass('d-none');
});

$('#home-blash-upload').click(function() {
    var input = $('#home-file-photo-upload').get()[0];
    const upload_button = $(this);

    if (input.files && input.files[0]) {

        if (input.files[0].size > 2*1024*1024) {
            alert('Max upload size is 2MB');
            return;
        }

        const file = input.files[0];
        
        const data = new FormData();
        data.append('file', file);
        data.append('type', 'header');
        data.append('_token', csrf_token);

        upload_button.find('.spinner-grow').removeClass('d-none');

        $.ajax({
            url: siteUrl + '/import-header-photo',
            method: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response)
            {
                $('.modal').modal('hide');
                upload_button.find('.spinner-grow').addClass('d-none');
                location.reload();  
            },
            fail: function(xhr, textStatus, errorThrown) {
                alert('Upload failed');
                upload_button.find('.spinner-grow').addClass('d-none');
            }
        });

    } else {
        alert("Please select your Photo");
    }
});

/**
 * Upload avatar
 */

function readAvatarURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#home-profile-avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#home-profile-avatar-upload').change(function() {
    readAvatarURL(this);
    $('.home-avatar-preview-container').removeClass('d-none');
});

$('#home-avatar-upload').click(function() {
    var input = $('#home-profile-avatar-upload').get()[0];
    const upload_button = $(this);

    if (input.files && input.files[0]) {

        if (input.files[0].size > 2*1024*1024) {
            alert('Max upload size is 2MB');
            return;
        }

        const file = input.files[0];
        
        const data = new FormData();
        data.append('file', file);
        data.append('type', 'profile');
        data.append('_token', csrf_token);

        upload_button.find('.spinner-grow').removeClass('d-none');

        $.ajax({
            url: siteUrl + '/import-header-photo',
            method: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response)
            {
                $('.modal').modal('hide');
                upload_button.find('.spinner-grow').addClass('d-none');
                location.reload();  
            },
            fail: function(xhr, textStatus, errorThrown) {
                alert('Upload failed');
                upload_button.find('.spinner-grow').addClass('d-none');
            }
        });

    } else {
        alert("Please select your Photo");
    }
});