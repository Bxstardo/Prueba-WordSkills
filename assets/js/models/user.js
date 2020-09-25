// Modal config

var idUser 

$('#add').click(function (){
    $('#Id').val("")
    removeValidate("#Id")
    $('#FirstName').val("")
    removeValidate("#FirstName")
    $('#LastName').val("")
    removeValidate("#LastName")
    $('#DepartmentId').val("")
    removeValidate("#DepartmentId")
    $("#Access").prop('checked', false);
    $('#send').val("save")
    $('#send').html("Guardar")
    $('#Id').attr('type','text')
    $('#label-id').css('display','block')
    $('#modal').modal().show()
    
})

function edit(id) {
    $.ajax({
        type: "POST",
        url: "?controller=user&method=edit",
        data: {
            Id : id,
        },
        success: function(response) {
            response = JSON.parse(response)
            userArray = response.user

            $("#Id").val(userArray[0].Id)
            removeValidate("#Id")
            $("#FirstName").val(userArray[0].FirstName)
            removeValidate("#FirstName")
            $('#LastName').val(userArray[0].LastName)
            removeValidate("#LastName")
            $('#DepartmentId').val(userArray[0].DepartmentId)
            removeValidate("#DepartmentId")
            $('#Access').val(userArray[0].Access)
            removeValidate("#Access")
            $('#Id').attr('type','hidden')
            $('#label-id').css('display','none')
       
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


$('#send').click(function (e){
    e.preventDefault()
    //validations
    validation = true
    !validateInput("#Id",['required','number']) ? validation = false : null
    !validateInput("#FirstName",['required','text']) ? validation = false : null
    !validateInput("#LastName",['required','text']) ? validation = false : null
    !validateInput("#DepartmentId",['required']) ? validation = false : null
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
        $('#Access').prop('checked') ? Access = "on" : Access = null

        $.ajax({
            type: "POST",
            url: "?controller=user&method=update",
            data: {
                Id : idUser,
                FirstName : $('#FirstName').val(),
                LastName : $('#LastName').val(),
                DepartmentId : $('#DepartmentId').val(),
                Access : Access,
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
            Id : id,
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

function updateAccess(id){
    $.ajax({
        type: "POST",
        url: "?controller=user&method=updateAccess",
        data: {
            Id : id,
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
        users += "<td>"+array[i].Id+"</td>"
        users += "<td>"+array[i].FirstName+"</td>"
        users += "<td>"+array[i].LastName+"</td>"
        users += "<td>"+array[i].Rol+"</td>"
        users += "<td>"
        if (array[i].StatusUser == "Active") {
            users += '<label class="switch">'
            users += '<input type="checkbox" onclick="updateStatus('+array[i].Id+')" checked>'
            users += '<span class="slider round"></span>'
            users += ' </label>'
        }else if (array[i].StatusUser == "Inactive") {
            users += '<label class="switch">'
            users += '<input type="checkbox" onclick="updateStatus('+array[i].Id+')" >'
            users += '<span class="slider round"></span>'
            users += ' </label>'
        } 
        users += "</td>"
        users += "<td>"
        if (array[i].Access == "on") {
            users += '<label class="switch">'
            users += '<input type="checkbox" onclick="updateStatus('+array[i].Id+')" checked>'
            users += '<span class="slider round"></span>'
            users += ' </label>'
        }else{
            users += '<label class="switch">'
            users += '<input type="checkbox" onclick="updateStatus('+array[i].Id+')" >'
            users += '<span class="slider round"></span>'
            users += ' </label>'
        } 
        users += "</td>"
        users += "<td>"
        users += '<a href="#" class="btn btn-primary" onclick="edit('+array[i].Id+')" style="margin-right:5px"><i class="fas fa-edit"></i></a>'  
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

