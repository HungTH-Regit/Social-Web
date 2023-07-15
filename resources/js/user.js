$('.btn-edit-profile').click(function() {
    $('.btn-save').show();
    $('.btn-upload').show();
    $('.text-user-name').hide();
    $('.input-user-name').show();
    $(this).hide();
});

$('.btn-upload').click(function() {
    $('.upload-avatar-user').click();
});

$('.upload-avatar-user').change(function () {
    const file = $('.upload-avatar-user')[0].files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imageUrl = e.target.result;
            $('.image-preview').attr('src', ` ${imageUrl}`);
        };
        reader.readAsDataURL(file);
    }
});
