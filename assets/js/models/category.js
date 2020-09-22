// Modal config

var idCategory 

$('#add').click(function (){
    $('#name').val("")
    removeValidate("#name")

    $('#send').val("save")
    $('#send').html("Guardar")
    $('#modal').modal().show()
    
})

function edit(id) {
    $.ajax({
        type: "POST",
        url: "?controller=category&method=edit",
        data: {
            id : id,
        },
        success: function(response) {
            response = JSON.parse(response)
            categoryArray = response.category
            $("#name").val(categoryArray[0].name)
            removeValidate("#name")
            $("#id").val(id)
            $('#send').val('edit')
            $('#send').html('Editar')
            $('#modal').modal().show()
            idCategory = id
        },
        statusCode: {
            404: function () {
                alert('web not found');
            }
        },
    });
}

function del(id) {
    swal({
        title: "¿Estas segur@?",
        text: "Estas apunto de eliminar una categoria",
        icon: "warning",
        buttons: {
            cancel : 'Cancelar',
            confirm : {text:'Si, estoy seguro',className:'sweet-warning'},
        },
    }).then((will)=>{
        if(will){
        $.ajax({
            type: "POST",
            url: "?controller=category&method=delete",
            data: {
                id : id,
            },
            success: function(response) {
                response = JSON.parse(response)
                categories = ""
                categoriesArray = response.categories
                updateDatatable(categoriesArray)
                swal("¡Se ha eliminado correctamente!", "Has eliminado una categoria", "success")

            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
        });
        }else{
        $("#all_petugas").click();
        }
    })
}

$('#send').click(function (e){
    e.preventDefault()
    //validations
    validation = true
    if(!validateInput("#name",['required','text']))  
        validation = false 
    if (!validation) {
        return
    }
    if($('#send').val()=="save"){
        $.ajax({
            type: "POST",
            url: "?controller=category&method=add",
            data: $("#form").serialize(),
            success: function(response) {
                response = JSON.parse(response)
                categories = ""
                categoriesArray = response.categories
                updateDatatable(categoriesArray)
                $('#modal').modal('toggle')
                swal("¡Se ha agregado correctamente!", "Has agregado una categoria", "success")
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
        });
    }else{
        $.ajax({
            type: "POST",
            url: "?controller=category&method=update",
            data: {
                id : idCategory,
                name : $('#name').val(),
            },
            success: function(response) {
                response = JSON.parse(response)
                categories = ""
                categoriesArray = response.categories
                updateDatatable(categoriesArray)
                $('#modal').modal('toggle')
                swal("¡Se ha actualizado correctamente!", "Has actualizado una categoria", "success")
            },
            statusCode: {
                404: function () {
                    alert('web not found');
                }
            },
        });
    }
})

function updateStatus(id){
    $.ajax({
        type: "POST",
        url: "?controller=category&method=updateStatus",
        data: {
            id : id,
        },
        success: function(response) {
            response = JSON.parse(response)
            categories = ""
            categoriesArray = response.categories
            updateDatatable(categoriesArray)
        },
        statusCode: {
            404: function () {
                alert('web not found');
            }
        },
    });
}

//datatable

function updateDatatable(array) {
    for (let i = 0; i < array.length; i++) {
        categories += "<tr>"
        categories += "<td>"+array[i].id+"</td>"
        categories += "<td>"+array[i].name+"</td>"
        categories += "<td>"+array[i].status+"</td>"
        categories += "<td>"
        categories += '<a href="#" class="btn btn-primary" onclick="edit('+array[i].id+')" style="margin-right:5px"><i class="fas fa-edit"></i></a>'
        categories += '<a href="#" class="btn btn-danger" onclick="del('+array[i].id+')"style="margin-right:5px"><i class="fas fa-trash-alt"></i></a>'
        if (array[i].status_id == 1) {
            categories += '<label class="switch">'
            categories += '<input type="checkbox" onclick="updateStatus('+array[i].id+')" checked>'
            categories += '<span class="slider round"></span>'
            categories += ' </label>'
        }else if (array[i].status_id == 2) {
            categories += '<label class="switch">'
            categories += '<input type="checkbox" onclick="updateStatus('+array[i].id+')" >'
            categories += '<span class="slider round"></span>'
            categories += ' </label>'
        } 
        categories += "</td>"
        categories += "</tr>"
    }
    $("#categories").DataTable().destroy().clear();
    $('#categories-body').html(categories)
    datatable();
}

function datatable(){
    $('#categories').DataTable({
        "language": {
            "decimal": ",",
            "thousands": ".",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoPostFix": "",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "processing": "Procesando...",
            "search": "Buscar:",
            "searchPlaceholder": "Término de búsqueda",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "aria": {
                "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "create": "Nuevo",
                "edit": "Cambiar",
                "remove": "Borrar",
                "copy": "Copiar",
                "csv": "fichero CSV",
                "excel": "tabla Excel",
                "pdf": "documento PDF",
                "print": "Imprimir",
                "colvis": "Visibilidad columnas",
                "collection": "Colección",
                "upload": "Seleccione fichero...."
            },
            "select": {
                "rows": {
                    _: '%d filas seleccionadas',
                    0: 'clic fila para seleccionar',
                    1: 'una fila seleccionada'
                }
            }
        }           
    });
}

