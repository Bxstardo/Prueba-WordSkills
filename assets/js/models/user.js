// Modal config

var idUser 

$('#add').click(function (){
    $('#name').val("")
    removeValidate("#name")
    $('#email').val("")
    removeValidate("#email")
    $('#role_id').val("")
    removeValidate("#role_id")
    $('#password').val("")
    removeValidate("#password")

    $('#send').val("save")
    $('#send').html("Guardar")
    $('#modal').modal().show()
    
})

function edit(id) {
    $.ajax({
        type: "POST",
        url: "?controller=user&method=edit",
        data: {
            id : id,
        },
        success: function(response) {
            response = JSON.parse(response)
            userArray = response.user
            $("#name").val(userArray[0].name)
            removeValidate("#name")
            $('#email').val(userArray[0].email)
            removeValidate("#email")
            $('#role_id').val(userArray[0].role_id)
            removeValidate("#role_id")
            $('#password').val(userArray[0].password)
            removeValidate("#password")
            $("#id").val(id)
            $('#send').val('edit')
            $('#send').html('Editar')
            $('#modal').modal().show()
            idUser = id
        },
        statusCode: {
            404: function () {
                alert('web not found');
            }
        },
    });
}

function del(id) {
    $.ajax({
        type: "POST",
        url: "?controller=user&method=delete",
        data: {
            id : id,
        },
        success: function(response) {
            response = JSON.parse(response)
            users = ""
            usersArray = response.users
            updateDatatable(usersArray)
        },
        statusCode: {
            404: function () {
                alert('web not found');
            }
        },
    });
}

$('#send').click(function (e){
    e.preventDefault()
    //validations
    validation = true
    if(!validateInput("#name",['required','text']))  
        validation = false 
    if(!validateInput("#email",['required','email']))  
        validation = false 
    if(!validateInput("#password",['required']))  
        validation = false 
    if(!validateInput("#role_id",['required']))  
        validation = false 
    if (!validation) {
        return
    }
    if($('#send').val()=="save"){
        $.ajax({
            type: "POST",
            url: "?controller=user&method=add",
            data: $("#form").serialize(),
            success: function(response) {
                response = JSON.parse(response)
                users = ""
                usersArray = response.users
                updateDatatable(usersArray)
                $('#modal').modal('toggle')

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
            url: "?controller=user&method=update",
            data: {
                id : idUser,
                name : $('#name').val(),
                email : $('#email').val(),
                role_id : $('#role_id').val(),
                password : $('#password').val(),
            },
            success: function(response) {
                response = JSON.parse(response)
                users = ""
                usersArray = response.users
                updateDatatable(usersArray)
                $('#modal').modal('toggle')

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
        url: "?controller=user&method=updateStatus",
        data: {
            id : id,
        },
        success: function(response) {
            response = JSON.parse(response)
            users = ""
            usersArray = response.users
            updateDatatable(usersArray)
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
        users += "<tr>"
        users += "<td>"+array[i].id+"</td>"
        users += "<td>"+array[i].name+"</td>"
        users += "<td>"+array[i].email+"</td>"
        users += "<td>"+array[i].rol+"</td>"
        users += "<td>"+array[i].status+"</td>"
        users += "<td>"
        users += '<a href="#" class="btn btn-primary" onclick="edit('+array[i].id+')" style="margin-right:5px"><i class="fas fa-edit"></i></a>'
        users += '<a href="#" class="btn btn-danger" onclick="del('+array[i].id+')"style="margin-right:5px"><i class="fas fa-trash-alt"></i></a>'
        if (array[i].status_id == 1) {
            users += '<label class="switch">'
            users += '<input type="checkbox" onclick="updateStatus('+array[i].id+')" checked>'
            users += '<span class="slider round"></span>'
            users += ' </label>'
        }else if (array[i].status_id == 2) {
            users += '<label class="switch">'
            users += '<input type="checkbox" onclick="updateStatus('+array[i].id+')" >'
            users += '<span class="slider round"></span>'
            users += ' </label>'
        } 
        users += "</td>"
        users += "</tr>"
    }
    $("#users").DataTable().destroy().clear();
    $('#users-body').html(users)
    datatable();
}

function datatable(){
    $('#users').DataTable({
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

