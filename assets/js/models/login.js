
$('#sendL').click(function (e){
    e.preventDefault()
    //validations
    validation = true

    if(!validateInput("#Id",['required','number']))  
        validation = false 
    if(!validateInput("#PasswordUser",['required']))  
        validation = false 
    if (!validation) {
        return
    }
    $('#form').submit()
})