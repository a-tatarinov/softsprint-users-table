$( document ).ready(function() {

    $('#all-items').on('click' , function() {
        if( $(this).prop('checked' ) ) {
            $('input[name="user\[\]"]').prop('checked', true);
        } else {
            $('input[name="user\[\]"]').prop('checked', false);
        }
    });

    $('input[name="user\[\]"]').on('click' , function() {
        if( !$(this).prop('checked' ) ) {
            $('#all-items').prop('checked', false);
        } else {
            all_checkboxes = $('input[name="user\[\]"]').length;
            checked_checkboxes = $('input[name="user\[\]"]:checked').length;
            if (all_checkboxes == checked_checkboxes) $('#all-items').prop('checked', true);
        }
    });
})
