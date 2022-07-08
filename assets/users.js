function userModalShow(text_title, html_body, html_footer = '', role_id = 0) {
    var $modal = $('#user-form-modal');

    $modal.find('#UserModalLabel').text(text_title);
    $modal.find('div.modal-body').html(html_body);
    $modal.find('div.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' + html_footer);

    if (role_id) $('#role option[value=' + role_id + ']').attr('selected', true);

    $modal.modal();
}

function userModalForm(data = {
        'id': null,
        'first_name': '',
        'last_name': '',
        'role_id': 0,
        'status': 0
    }) {

    var text_title = 'Add/Edit user';

    var html_body = '';

    html_body += '<form>';
    html_body += '<input type="hidden" name="id" value="' + data.id + '">';
    html_body += '<div class="form-group">';
    html_body += '    <label for="first-name" class="col-form-label">First Name:</label>';
    html_body += '    <input type="text" class="form-control" id="first-name" name="first_name" value="' + data.first_name + '" placeholder="Ім\'я">';
    html_body += '</div>';
    html_body += '<div class="form-group">';
    html_body += '    <label for="last-name" class="col-form-label">Last Name:</label>';
    html_body += '    <input type="text" class="form-control" id="last-name" name="last_name" value="' + data.last_name + '" placeholder="Прізвище">';
    html_body += '</div>';
    html_body += '<fieldset class="form-group row">';
    html_body += '    <legend for="status" class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>';
    html_body += '    <div class="col-sm-10">';
    html_body += '        <div class="form-check">';
    html_body += '           <input class="form-check-input" type="checkbox" id="status" name="status" value="1" ' + (data.status ? 'checked' : '') + '/>';
    html_body += '        </div>';
    html_body += '    </div>';
    html_body += '</fieldset>';
    html_body += '<div class="form-group row">';
    html_body += '     <label for="role" class="col-sm-2 col-form-label">Role</label>';
    html_body += '     <div class="col-sm-4">';
    html_body += '        <select class="form-control" id="role" name="role">';
    html_body +=            $('#roles-values').html();
    html_body += '        </select>';
    html_body += '     </div>';
    html_body += '</div></form>';

    var html_footer = '<button type="button" class="btn btn-success" onclick="setUser()">Save</button>';

    userModalShow(text_title, html_body, html_footer, data.role_id);
}

function deleteUser(id) {
    $.ajax({
        url: 'api?type=delete',
        method: 'POST',
        dataType: 'json',
        data: {'id': id},
        success: function(json){
            console.log(json);
            // userModalForm(json.user)
        },
        error: function(){
            var text_title = 'Eror warning';
            var html_body = 'Виникла помилка при підключенні до серверу!';
            userModalShow(text_title, html_body);
        }
    });
}

function setUser() {
    var data = $('#user-form-modal form').serialize();

    console.log(data);


}

$(function (){

    $('input[name="selected\[\]"]').on('click', function() {
        if(!$(this).prop('checked') ) {
            $('#all-items').prop('checked', false);
        } else if($('input[name="selected\[\]"]').length == $('input[name="selected\[\]"]:checked').length) {
            $('#all-items').prop('checked', true);
        }
    })

    $('button.user-add').on('click', function() {
        userModalForm();
    })

    $('button.user-edit').on('click', function() {
        $.ajax({
            url: 'api?type=edit',
            method: 'POST',
            dataType: 'json',
            data: {'id': $(this).closest('tr').data('id')},
            success: function(json){
                userModalForm(json.user)
            },
            error: function(){
                var text_title = 'Eror warning';
                var html_body = 'Виникла помилка при підключенні до серверу!';
                userModalShow(text_title, html_body);
            }
        });
    })

    $('button.user-delete').on('click', function() {
        var user_id = $(this).closest('tr').data('id');
        var user_name = $('#user' + user_id + ' td.user-name').text();

        var text_title = 'Видалення користувача';
        var html_body = 'Ви дісно бажаєте видалити користувача <b>' + user_name + '</b> ?';
        var html_footer = '<button type="button" class="btn btn-danger" onclick="deleteUser(' + user_id + ')">Ok</button>';

        userModalShow(text_title, html_body, html_footer);
    })

    $('button.user-edit-set').on('click', function() {

        var users_select = $('input[name="selected\[\]"]').serialize();
        var operation = $(this).prev('select').val();

        if(!users_select) {
            var text_title = 'Перевірте обрані дані!';
            if (operation == '*') var html_body = 'Оберіть користувачів та що потрібно зробити!';
            else var html_body = 'Оберіть користувачів!';
            userModalShow(text_title, html_body);
            return false;
        } else if(operation == '*') {
            var text_title = 'Перевірте обрані дані!';
            var html_body = 'Оберіть що потрібно зробити!';
            userModalShow(text_title, html_body);
            return false;
        }

        //ajax edit
    })

    // mdc.ripple.MDCRipple.attachTo(document.querySelector('.mdc-switch'));
})
