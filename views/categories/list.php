<main>
    <div class="jumbotron text-center">
        <h1>Categorias</h1>
        <br>
        <button class="btn btn-primary" id="add">Agregar categoria</button>
    </div>

    <div class="container">
        <div class="col-md-12">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="categories" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="categories-body">
                    <?php 
                    foreach ($categories as $category):
                    ?>
                    <tr>
                        <td><?php echo $category->id ?></td>
                        <td><?php echo $category->name ?></td>
                        <td><?php echo $category->status ?></td>
                        <td>
                            <a href="#" class="btn btn-primary" onclick="edit(<?php echo $category->id ?>)"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger" onclick="del(<?php echo $category->id ?>)"><i class="fas fa-trash-alt"></i></a>
                            <?php if($category->status_id == 1): ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateStatus(<?php echo $category->id ?>)" checked>
                                    <span class="slider round"></span>
                                </label>
                            <?php elseif($category->status_id == 2): ?>
                                <label class="switch">
                                    <input type="checkbox" onclick="updateStatus(<?php echo $category->id ?>)">
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
                    <h5 class="modal-title" id="modalLabel">Información de la categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control"  placeholder="Nombre de la categoria">
                        <div class="invalid-feedback" id="name-error">
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
    <script src="assets/js/models/category.js"></script>
    <script>
    $(document).ready(function() {
        datatable()
    });
</script>

</main>
