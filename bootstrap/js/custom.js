$(document).ready(function () {

    setTimeout(function () {
        $('.alert').hide('slow');

    }, 3000);


    $('#select-all').on('click', function () {
        if (this.checked) {
            $('.my-class').each(function () {
                this.checked = true;
                $('#delete-all').show();
            });
        } else {
            $('.my-class').each(function () {
                this.checked = false;
                $('#delete-all').hide();
            });
        }
    });


});