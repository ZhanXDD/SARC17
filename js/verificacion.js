//When document ready
$(function(){

    //Event when name has lost focus
    $('#name').on('blur', function(){
        if(!this.value)
            $('#nameError').text('El campo esta vacio');
    });
    //Event when name has changed input text
    $('#name').on('input', function(){
        if(this.value)
            $('#nameError').text('');
    });

    //Event when email has lost focus
    $('#email').on('blur', function(){
        if(!this.value.match(/^.+@.*\..{2,}$/))
            $('#emailError').append('El correo tiene el formato incorrecto');
    });
    //Event when email has changed input text
    $('#email').on('input', function(){
        if(this.value.match(/^.+@.*\..{2,}$/))
            $('#emailError').text('');
    });

    //Event when phone has lost focus
    $('#phone').on('blur', function(){
        //if phone has value, check if it contains at least 9 digits
        if(this.value && !this.value.match(/^[0-9]{9,}$/)){
            $('#phoneError').text('El telefono tiene tener al menos nueve numeros');
        }
    });
    //Event when phone has change input text
    $('#phone').on('input', function(){
        //if phone doesn't has value or check if it contains at least 9 digits
        if(!this.value || this.value.match(/^[0-9]{9,}$/)){
            $('#phoneError').text('');
        }
    });

    //Event when password has lost focus
    $('#password').on('blur', function(){
        //check if password has 8 characters
        if(!this.value.match(/^.{8,}$/))
            $('#passError').text('La contraseña tiene que tener al menos ocho caracteres');
    });
    //Event when email has changed input text
    $('#password').on('input', function(){
        //check if password has 8 characters
        if(this.value.match(/^.{8,}$/))
            $('#passError').text('');
    });

    //Event when password2 has lost focus
    $('#password2').on('blur', function(){
        //check for different password
        if(this.value != $('#password').val())
            $('#pass2Error').text('La contraseña es diferente');
    });
    //Event when password2 has changed input text
    $('#password2').on('input', function(){
        //check for different password
        if(this.value == $('#password').val())
            $('#pass2Error').text('');
    });

    //Event when form is submmited
    $('#form').on('submit', function(event){
        
        let errors = [$('#nameError').text(), $('#emailError').text(), $('#phoneError').text(), $('#passError').text(), $('#pass2Error').text()];
        let inputs = [$('#name').val(), $('#email').val(), $('#password').val(), $('#password2').val()];
        
        //check for empty required inputs
        for(let i = 0; i < inputs.length; i++){
            if(!inputs[i]){
                event.preventDefault();
                $('#generalError').text('Hay campos obligatorios no llenos');
                return false;
            }
        }

        //check for shown errors
        for(let i = 0; i < errors.length; i++){
            if(errors[i]){
                event.preventDefault();
                $('#generalError').text('Hay datos introducidos erroneos');
                return false;
            }
        }
        return true;
    });
});