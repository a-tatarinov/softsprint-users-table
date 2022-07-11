var popup_id = 0;

function userModalShow(text_title, html_body, html_footer = '', role_id = 0) {
    var $modal = $('#user-form-modal');

    $modal.find('#UserModalLabel').text(text_title);
    $modal.find('div.modal-body').html(html_body);
    $modal.find('div.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' + html_footer);

    if (role_id) $('#role option[value=' + role_id + ']').attr('selected', true);

    $modal.modal();
}

function createUserForm(data = {
        'id': null,
        'first_name': '',
        'last_name': '',
        'role_id': 0,
        'status': 0
    }) {

    var text_title = 'Add/Edit user';

    var html_body = '';

    html_body += '<form id="user-form">';
    html_body += '<input type="hidden" name="id" value="' + data.id + '">';
    html_body += '<div class="form-group required">';
    html_body += '    <label for="first-name" class="col-form-label">First Name:</label>';
    html_body += '    <input type="text" class="form-control" id="first-name" name="first_name" value="' + data.first_name + '" placeholder="Ім\'я" required>';
    html_body += '</div>';
    html_body += '<div class="form-group required">';
    html_body += '    <label for="last-name" class="col-form-label">Last Name:</label>';
    html_body += '    <input type="text" class="form-control" id="last-name" name="last_name" value="' + data.last_name + '" placeholder="Прізвище" required>';
    html_body += '</div>';
    html_body += '<fieldset class="form-group row">';
    html_body += '    <legend for="status" class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>';
    html_body += '    <div class="col-sm-10">';
    html_body += '        <label class="google-switch">';
    html_body += '            <input type="checkbox" id="status" name="status" value="1" ' + (data.status ? 'checked' : '') + ' />';
    html_body += '            <span class="switcher"></span>';
    html_body += '        </label>';
    html_body += '    </div>';
    html_body += '</fieldset>';
    html_body += '<div class="form-group row">';
    html_body += '     <label for="role" class="col-sm-2 col-form-label">Role</label>';
    html_body += '     <div class="col-sm-4">';
    html_body += '        <select class="form-control" id="role" name="role_id">';
    html_body +=            $('#roles-values').html();
    html_body += '        </select>';
    html_body += '     </div>';
    html_body += '</div></form>';

    var html_footer = '<input class="btn btn-success" type="submit" value="Save" form="user-form">';

    userModalShow(text_title, html_body, html_footer, data.role_id);
}

function popup (text, popClass) {
    html  = '<div class="alert alert-' + popClass + ' alert-dismissible fade show" role="alert" id="popup' + popup_id + '">';
    html += text;
    html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    html += '</div>';
    $('#popup_content').append(html);
    $('#popup'+popup_id).fadeIn('slow').delay(5000).fadeOut('slow', () => $(this).remove());
    popup_id++;
}

function deleteUser(id) {
    var user_name = $('#user' + id + ' td.user-name').text();

    $.ajax({
        url: 'api?type=delete',
        method: 'POST',
        dataType: 'json',
        data: {'id': id},
        success: function(json){
            if (json.status) {
                $('#user-form-modal').modal('hide');
                $('#user' + id).fadeOut('slow', () => $(this).remove());
                popup('Користувача <strong>' + user_name + '</strong> видалено!', 'success');
            }
        },
        error: function(){
            var text_title = 'Eror warning';
            var html_body = 'Виникла помилка при підключенні до серверу!';
            userModalShow(text_title, html_body);
        }
    });
}

$(function () {

    $('input[name="selected\[\]"]').on('click', function() {
        if (!$(this).prop('checked') ) {
            $('#all-items').prop('checked', false);
        } else if ($('input[name="selected\[\]"]').length == $('input[name="selected\[\]"]:checked').length) {
            $('#all-items').prop('checked', true);
        }
    })

    $('button.user-edit-set').on('click', function() {

        var ids = $('input[name="selected\[\]"]').serialize();
        var operation = $(this).prev('select').val();

        if (!ids) {
            var text_title = 'Перевірте обрані дані!';
            if (operation == '*') var html_body = 'Оберіть користувачів та що потрібно зробити!';
            else var html_body = 'Оберіть користувачів!';
            userModalShow(text_title, html_body);
            return false;
        } else if (operation == '*') {
            var text_title = 'Перевірте обрані дані!';
            var html_body = 'Оберіть що потрібно зробити!';
            userModalShow(text_title, html_body);
            return false;
        }

        $.ajax({
            url: 'api?type=update',
            method: 'POST',
            dataType: 'json',
            data: ids + '&operation=' + operation,
            success: function(json){
                if (json.status) {
                    json.id.forEach(function(item) {
                        if (operation === 'active') {
                            $('#user' + item + ' td.user-status i.not-active-circle').removeClass('not-active-circle').addClass('active-circle');
                        } else if (operation === 'noactive') {
                            $('#user' + item + ' td.user-status i.active-circle').removeClass('active-circle').addClass('not-active-circle');
                        } else if (operation === 'delete') {
                            $('#user' + item).fadeOut('slow', () => $(this).remove());
                        }
                    });
                }
            },
            error: function(){
                var text_title = 'Eror warning';
                var html_body = 'Виникла помилка при підключенні до серверу!';
                userModalShow(text_title, html_body);
            }
        });
    })

    $('button.user-add').on('click', function() {
        createUserForm();
    })

    $('tbody').on('click', 'button.user-edit', function() {
        $.ajax({
            url: 'api?type=getuser',
            method: 'POST',
            dataType: 'json',
            data: {'id': $(this).closest('tr').data('id')},
            success: function(json){
                createUserForm(json.user);
            },
            error: function(){
                var text_title = 'Eror warning';
                var html_body = 'Виникла помилка при підключенні до серверу!';
                userModalShow(text_title, html_body);
            }
        });
    })

    $('tbody').on('click', 'button.user-delete', function() {
        var user_id = $(this).closest('tr').data('id');
        var user_name = $('#user' + user_id + ' td.user-name').text();

        var text_title = 'Видалення користувача';
        var html_body = 'Ви дісно бажаєте видалити користувача <b>' + user_name + '</b> ?';
        var html_footer = '<button type="button" class="btn btn-danger" onclick="deleteUser(' + user_id + ')">Ok</button>';

        userModalShow(text_title, html_body, html_footer);
    })

    $('#user-form-modal').on('submit', '#user-form',function() {
        $.ajax({
            url: 'api?type=setuser',
            method: 'POST',
            dataType: 'json',
            data: $('#user-form').serialize(),
            success: function(json){
                if (json.status) {
                    html = '<tr id="user' + json.user['id'] + '" data-id="' + json.user['id'] + '">';
                    html += '    <td class="align-middle text-center">';
                    html += '    <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">';
                    html += '        <input type="checkbox" class="custom-control-input" id="item-' + json.user['id'] + '" name="selected[]" value="' + json.user['id'] + '" />';
                    html += '        <label class="custom-control-label" for="item-' + json.user['id'] + '"></label>';
                    html += '    </div>';
                    html += '    </td>';
                    html += '    <td class="text-nowrap align-middle user-name">';
                    html +=         json.user['first_name'] + ' ' + json.user['last_name'];
                    html += '    </td>';
                    html += '    <td class="text-center align-middle">';
                    if (json.user['status']) {
                    html += '       <i class="fa fa-circle active-circle"></i>';
                    } else {
                    html += '       <i class="fa fa-circle not-active-circle"></i>';
                    }
                    html += '    </td>';
                    html += '    <td class="text-nowrap align-middle">';
                    html += '        <span>' + $('#roles-values option[value=' + json.user['role_id'] + ']').text() + '</span>';
                    html += '    </td>';
                    html += '    <td class="text-center align-middle">';
                    html += '    <div class="btn-group align-top">';
                    html += '        <button class="btn btn-sm btn-outline-secondary badge user-edit" type="button"><i class="fa fa-pencil fa-lg"></i></button>';
                    html += '        <button class="btn btn-sm btn-outline-secondary badge user-delete" type="button"><i class="fa fa-trash fa-lg"></i></button>';
                    html += '    </div>';
                    html += '    </td>';
                    html += '</tr>';

                    if ($('#user' + json.user['id']).length > 0) {
                        $('#user' + json.user['id']).replaceWith(html);
                        var text = 'Дані успішно оновлено!';
                    } else {
                        $('tbody').append(html);
                        var text = 'Новового користувача додано!'
                    }

                    $('#user-form-modal').modal('hide');
                    popup(text, 'success');
                }
                console.log(json);
            },
            error: function(){
                var text_title = 'Eror warning';
                var html_body = 'Виникла помилка при підключенні до серверу!';
                userModalShow(text_title, html_body);
            }
        });
        return false;
    })
})
