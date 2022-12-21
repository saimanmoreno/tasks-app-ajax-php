$(document).ready(function () {

    $('#search').keyup(function (e) {

        let searchText = $('#search').val()

        $.ajax({
            url: 'server/controller.php',
            type: 'POST',
            data: { action: 'searchTasks', searchText },
            success: function (response) {
                console.log(response);
            }
        })
    })
})