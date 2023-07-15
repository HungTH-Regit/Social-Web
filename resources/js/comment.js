var page = 1;

$(document).on('click', '#sendComment', function () {
    let route = $(this).data('route');
    let contentComment = $('#contentComment').val();
    $.ajax({
        url: route,
        type: "POST",
        dataType: "json",
        data: {
            content: contentComment
        },

        success: function (response) {
            $('#contentComment').val('').empty();
            $('.all-comment').html(response.tableView);
        },
        error: function (xhr, status, error) {
            console.log(error)
        },
    });
});

$(document).on('click', '#viewMoreComment', function () {
    let btnViewMore = $(this);
    let blogId = $(this).data('id');
    let route = $(this).data('route');
    let lastPage = $(this).data('page-last');
    page++;

    $.ajax({
        url: route,
        type: "GET",
        dataType: "json",
        data: {
            page: page,
            id: blogId
        },

        success: function (response) {
            if (page === lastPage) {
                btnViewMore.hide();
            }
            $('.all-comment').append(response.tableView);

        },
        error: function (xhr, status, error) {
            console.log(error)
        },
    });
})
