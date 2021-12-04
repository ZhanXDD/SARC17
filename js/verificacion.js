/**
 * Function to verify if inserted parameter is empty
 * @param {*} input to check for empty elements
 * @returns true if there is an empty element, false otherwise
 */
function emptyValues(input){
    if(input == ""){
        console.log("true");
        return true;
    }
    console.log("false");
    return false;
}

//When document ready
$(function(){

    //When element with id name has lost focus
    $('#name').on('blur', function(){
        //check if name is empty
        if(!this.value)
            $('#nameError').text('El campo esta vacio');
    });

    $('#name').on('input', function(){
        //check if name is not empty
        if(this.value)
            $('#nameError').text('');
    });

    //When element with id email has lost focus
    $('#email').on('blur', function(){
        //check if email does not comply with regexp
        if(!this.value.match(/^.+@.*\..{2,}$/))
            $('#emailError').append('El correo tiene el formato incorrecto');
    });

    $('#email').on('input', function(){
        //check if email complies with regexp
        if(this.value.match(/^.+@.*\..{2,}$/))
            $('#emailError').text('');
    });

    //When element with id phone has lost focus
    $('#phone').on('blur', function(){
        //if phone has value, check if it contains at least 9 digits
        if(this.value && !this.value.match(/^[0-9]{9,}$/)){
            $('#phoneError').text('El telefono tiene tener al menos nueve numeros');
        }
    });

    $('#phone').on('input', function(){
        //if phone has value, check if it contains at least 9 digits
        if(!this.value || this.value.match(/^[0-9]{9,}$/)){
            $('#phoneError').text('');
        }
    });

    //When element with id password has lost focus
    $('#password').on('blur', function(){
        //check if password has 8 characters
        if(!this.value.match(/^.{8,}$/))
            $('#passError').text('La contraseña tiene que tener al menos ocho caracteres');
    });

    $('#password').on('input', function(){
        //check if password has 8 characters
        if(this.value.match(/^.{8,}$/))
            $('#passError').text('');
    });

    //When element with id password2 has lost focus
    $('#password2').on('blur', function(){
        //check for different password
        if(this.value != $('#password').val())
            $('#pass2Error').text('La contraseña es diferente');
    });

    $('#password2').on('input', function(){
        //check for different password
        if(this.value == $('#password').val())
            $('#pass2Error').text('');
    });

    $('#form').on('submit', function(event){
        
        let errors = [$('#nameError').text(), $('#emailError').text(), $('#phoneError').text(), $('#passError').text(), $('#pass2Error').text()];
        let inputs = [$('#name').val(), $('#email').val(), $('#password').val(), $('#password2').val()];
        for(let i = 0; i < inputs.length; i++){
            console.log(inputs[i]);
            if(!inputs[i]){
                event.preventDefault();
                $('#generalError').text('Hay campos obligatorios no llenos');
                console.log('datos vacios');
                return false;
            }
        }
        for(let i = 0; i < errors.length; i++){
            console.log(errors[i]);
            if(errors[i]){
                event.preventDefault();
                console.log('datos incorrecto');
                $('#generalError').text('Hay datos introducidos erroneos');
                return false;
            }
        }
    });
});