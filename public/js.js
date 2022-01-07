
    $(document).on('click', '#delete-gallery', function () {
        let id = $(this).data('id');

        $.ajax({
            url: `/galleries/${id}`,
            method: 'delete',
            dataType: 'json',
            success: function () {
                window.location = '/'
            },
            error: function () {
                window.location = '/'
            }
        })

    })

    $(document).on('click', '#delete-image', function () {
        let id = $(this).data('id');

        $.ajax({
            url: `/images/${id}`,
            method: 'DELETE',
            dataType: 'json',
            success: function () {
                window.location = `/`
            },
            error: function () {
                window.location = `/`
            }
        })

    })


