$(document).ready(function () {
    $('.btn-data').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'server.php',
            method: 'post',
            data: $(this).serialize(),
            success: function (data) {
                data = JSON.parse(data);
                if(data.status) {
                    $('.data-base').fadeIn(500);
                }
            }
        })
    })
});