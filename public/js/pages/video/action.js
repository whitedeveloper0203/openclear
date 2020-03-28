function readURL(input) {
    if (input.files && input.files[0]) {
        let file = input.files[0];
        let blobURL = URL.createObjectURL(file);
        $('#blah').attr('src', blobURL);
    }
}

$('.file-photo-upload').on('change', function() {
    var file = this.files[0];
    readURL(this);
    $('.photo-preview-container').removeClass('d-none');
});

$('#blash-upload').click(function() {
    var input = $('.file-photo-upload').get()[0];
    const upload_button = $(this);

    if (input.files && input.files[0]) {

        if (input.files[0].size > 2*1024*1024) {
            alert('Max upload size is 2MB');
            return;
        }

        const photo_title = $('#id-photo-title').val();
        const file = input.files[0];
        
        const data = new FormData();
        data.append('file', file);
        data.append('title', photo_title);
        data.append('_token', csrf_token);

        upload_button.find('.spinner-grow').removeClass('d-none');

        $.ajax({
            url: siteUrl + '/import/video',
            method: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response)
            {
                $('.modal').modal('hide');
                location.reload();
                upload_button.find('.spinner-grow').addClass('d-none');
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