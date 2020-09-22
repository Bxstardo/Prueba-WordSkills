/**
 * Create by: Brayan Martinez Ayala
 * GitHub-Bitbucket: bxstardo 
 * Version: 1.0
 */
const textPattern = new RegExp(/^[A-Z ]+$/i);
const emptyPattern = new RegExp(/^\s/)
const namePattern = new RegExp("^[a-zA-ZÀ-ÿ\u00f1\u00d1 ]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1 ]+$");
const emailPattern = new RegExp("^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$");
const numberPattern = new RegExp("^[0-9]+$");

function validateInput(input,rules){
    $(input).on('keyup', function() {
        validate(input,['required','text'])
    });
    $(input).on('change', function() {
        validate(input,['required','text'])
    });
    function validate() {
        $(input).removeClass('is-valid')
        $(input).removeClass('is-invalid')
        for (let i = 0; i < rules.length; i++) {
            switch (rules[i]) {
                case 'required':
                    if (emptyPattern.test($(input).val()) || $(input).val() == "") {
                        $(input).addClass('is-invalid')
                        $(input+"-error").css('display','block')
                        $(input+"-error").html('Por favor no deje vacío este campo')
                        return false
                    }
                    break;
                case 'text':
                    if (!textPattern.test($(input).val())) {
                        $(input).addClass('is-invalid')
                        $(input+"-error").css('display','block')
                        $(input+"-error").html('Por favor escriba solo letras en este campo')
                        return false
                    }
                    break;
                case 'number':
                    if (!numberPattern.test($(input).val())) {
                        $(input).addClass('is-invalid')
                        $(input+"-error").css('display','block')
                        $(input+"-error").html('Por favor escriba solo números en este campo')
                        return false
                    }
                break;
                case 'email':
                    if (!emailPattern.test($(input).val())) {
                        $(input).addClass('is-invalid')
                        $(input+"-error").css('display','block')
                        $(input+"-error").html('Por favor escriba un correo valido en minúsculas en este campo')
                        return false
                    }
                break;
                case 'name':
                    if (!namePattern.test($(input).val())) {
                        $(input).addClass('is-invalid')
                        $(input+"-error").css('display','block')
                        $(input+"-error").html('Por favor escriba solo letras en este campo')
                        return false
                    }
                break;
            }
        } 
        $(input).addClass('is-valid')
        $(input+"-error").css('display','none')
        return true
    }
    return validate()
}

function removeValidate(input){
    $(input).removeClass("is-valid")
    $(input).removeClass("is-invalid")
}