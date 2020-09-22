<main>
    <div class="jumbotron text-center">
        <h1>Usuarios</h1>
        <br>
        <button class="btn btn-primary" id="add">Agregar usuario</button>
    </div>

    <div class="container">
        <div class="col-md-12">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="users" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="users-body">
                    <?php 
                    foreach ($users as $user):
                    ?>
                    <tr>
                        <td><?php echo $user->id ?></td>
                        <td><?php echo $user->name ?></td>
                        <td><?php echo $user->email ?></td>
                        <td><?php echo $user->rol ?></td>
                        <td><?php echo $user->status ?></td>
                        <td>
                            <a href="#" class="btn btn-primary" onclick="edit(<?php echo $user->id ?>)"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger" onclick="del(<?php echo $user->id ?>)"><i class="fas fa-trash-alt"></i></a>
                            <?php if($user->status_id == 1): ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateStatus(<?php echo $user->id ?>)" checked>
                                    <span class="slider round"></span>
                                </label>
                            <?php elseif($user->status_id == 2): ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateStatus(<?php echo $user->id ?>)">
                                    <span class="slider round"></span>
                                </label>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>  

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Información del usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <div class="invalid-feedback" id="name-error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="text" name="email" id="email" class="form-control">
                        <div class="invalid-feedback" id="email-error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <div class="invalid-feedback" id="password-error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Roles</label>
                        <select name="role_id" id="role_id" class="form-control" value="">
                            <option value="" disabled>Seleccione un rol</option>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?php echo $rol->id ?>"><?php echo $rol->name ?></option>
                            <?php endforeach ?>
                            <option value=""></option>
                        </select>
                        <div class="invalid-feedback" id="role_id-error">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" type="submit" id="send"></button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="assets/js/models/user.js"></script>
    <script>
    $(document).ready(function() {
        datatable()
    });
</script>

</main>
