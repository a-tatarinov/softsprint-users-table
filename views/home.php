<?php include_once 'header.php'; ?>

<div class="container">
    <span id="popup_content"></span>
    <div class="row flex-lg-nowrap">
        <div class="col">
        <div class="row flex-lg-nowrap">
            <div class="col mb-3">
            <div class="e-panel card">
                <div class="card-body">
                <div class="card-title">
                    <h6 class="mr-2"><span>Users</span></h6>
                </div>
                <div class="e-table">

                    <?php include 'block_change.php'; ?>

                    <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="align-top text-center">
                            <div
                                class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                                <input type="checkbox" class="custom-control-input" id="all-items" onclick="$('input[name=\'selected\[\]\']').prop('checked', this.checked);">
                                <label class="custom-control-label" for="all-items"></label>
                            </div>
                            </th>
                            <th class="max-width">Name</th>
                            <th>Status</th>
                            <th class="sortable">Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr id="user<?= $user['id'] ?>" data-id="<?= $user['id'] ?>">
                                <td class="align-middle text-center">
                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                    <input type="checkbox" class="custom-control-input" id="item-<?= $user['id'] ?>" name="selected[]" value="<?= $user['id'] ?>" />
                                    <label class="custom-control-label" for="item-<?= $user['id'] ?>"></label>
                                </div>
                                </td>
                                <td class="text-nowrap align-middle user-name">
                                    <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                                </td>
                                <td class="text-center align-middle user-status">
                                    <?php if($user['status']) : ?>
                                        <i class="fa fa-circle active-circle"></i>
                                    <?php else: ?>
                                        <i class="fa fa-circle not-active-circle"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-nowrap align-middle">
                                    <span><?= $roles[$user['role_id']] ?></span>
                                </td>
                                <td class="text-center align-middle">
                                <div class="btn-group align-top">
                                    <button class="btn btn-sm btn-outline-secondary badge user-edit" type="button"><i class="fa fa-pencil fa-lg"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary badge user-delete" type="button"><i class="fa fa-trash fa-lg"></i></button>
                                </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>

                    <?php include 'block_change.php'; ?>

                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- User Form Modal -->

        <div class="modal fade" id="user-form-modal" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                            <!--
                            <button id="basic-switch" class="mdc-switch mdc-switch--unselected mdc-theme--background" type="button" role="switch" aria-checked="false">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__handle-track">
                                <div class="mdc-switch__handle">
                                <div class="mdc-switch__shadow">
                                    <div class="mdc-elevation-overlay"></div>
                                </div>
                                <div class="mdc-switch__ripple"></div>
                                <div class="mdc-switch__icons">
                                    <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                                    <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                                    </svg>
                                    <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                                    <path d="M20 13H4v-2h16v2z" />
                                    </svg>
                                </div>
                                </div>
                            </div>
                            </button>
                            <label for="basic-switch">off/on</label>
                            -->


            </div>
            <div class="modal-footer"></div>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

<select id="roles-values" style="display: none;">
    <?php foreach ($roles as $id => $role) : ?>
        <option value="<?=$id?>"><?=$role?></option>
    <?php endforeach; ?>
</select>

<?php include_once 'footer.php'; ?>
