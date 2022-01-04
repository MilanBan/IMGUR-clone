
    $(document).on('click', '#delete-gallery', function () {
        let id = $(this).data('id');

        $.ajax({
            url: `/galleries/${id}`,
            method: 'delete',
            dataType: 'json',
            success: function (data) {
                window.location = '/'
            },
            error: function ($xhr) {
                window.location = '/'
            }
        })

    })

