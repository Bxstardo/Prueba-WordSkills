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
                        <th>EmplooyeId</th>
                        <th>Names</th>
                        <th>Last Names</th>
                        <th>Rol</th>
                        <th>Status</th>
                        <th>Access Room_911</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="users-body">
                    <?php 
                    foreach ($users as $user):
                    ?>
                    <tr>
                        <td><?php echo $user->Id ?></td>
                        <td><?php echo $user->FirstName ?></td>
                        <td><?php echo $user->LastName ?></td>
                        <td><?php echo $user->Rol ?></td>
                        <td>
                            <?php if($user->StatusUser == "Active"): ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateStatus(<?php echo $user->Id ?>)" checked>
                                    <span class="slider round"></span>
                                </label>
                            <?php elseif($user->StatusUser == "Inactive"): ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateStatus(<?php echo $user->Id ?>)">
                                    <span class="slider round"></span>
                                </label>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if($user->Access == "on"): ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateAccess(<?php echo $user->Id ?>)" checked>
                                    <span class="slider round"></span>
                                </label>
                            <?php else: ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateAccess(<?php echo $user->Id ?>)">
                                    <span class="slider round"></span>
                                </label>
                            <?php endif ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary" onclick="edit(<?php echo $user->Id ?>)"><i class="fas fa-edit"></i></a>
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
                    <h5 class="modal-title" id="modalLabel">User information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Id" id="label-id">Identification Number</label>
                        <input type="text" name="Id" id="Id" class="form-control">
                        <div class="invalid-feedback" id="Id-error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FirstName">Names</label>
                        <input type="text" name="FirstName" id="FirstName" class="form-control">
                        <div class="invalid-feedback" id="FirstName-error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName">Last Names</label>
                        <input type="text" name="LastName" id="LastName" class="form-control">
                        <div class="invalid-feedback" id="LastName-error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="DepartmentId">Departments</label>
                        <select name="DepartmentId" id="DepartmentId" class="form-control" value="">
                            <option value="" >Select a department</option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?php echo $department->Id ?>"><?php echo $department->Department ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>        
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="Access" name="Access" >
                        <label class="form-check-label" for="Access">Access to room_911</label>
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
