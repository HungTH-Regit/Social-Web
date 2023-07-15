$(window).scroll(function () {
    const header = $('.container-header');
    $(window).scrollTop() > 0 ? header.addClass('header-scrolled') : header.removeClass('header-scrolled');
});

$('.select-category').change(function () {
    location.href = $(this).val();
});

$('.btn-upload-img').click(function () {
    $('.upload-image-blog').click();
});

$('.upload-image-blog').change(function () {
    const file = $('.upload-image-blog')[0].files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imageUrl = e.target.result;
            $('.img-preview').html(` <img src = "${imageUrl}" alt = "Image Preview" > `);
            $('.img-preview').show();
        };
        reader.readAsDataURL(file);
    }
});

$('.all-blog').slick({
    infinite: true,
    dots: true,
    arrows: false,
    autoplaySpeed: 1500,
    draggable: true,
});

if ($(window).width() <= 768) {
    $('.related-img').slick({
        infinite: true,
        dots: true,
        arrows: false,
        autoplaySpeed: 1500,
        draggable: true,
    });
}

$('.icon-show-menu').click(function () {
    $('.menu-mobile').css('width','100%');
});

$('.icon-show-search').click(function () {
    $('.search-mobile').css('width','100%');
});

$('.icon-close-menu').click(function () {
    $('.menu-mobile').width(0);
    $('.search-mobile').width(0);
});

$('.delete-blog').click(function () {
    $('.box-delete').show();
});
$('.cancel-box-delete').click(function () {
    $('.box-delete').hide();
});
