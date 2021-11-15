$(function(){
    function verificarRegistro(){
        let nombre = $("#nombre");
        let correo = $("#correo");
        let numero = $("#numero");
        let pass = $("#password");
        let pass2 = $("#password2");

        const fill = [nombre, correo, pass, pass2];
        if(emptyValues(fill)){
            //escribir error
            return false;
        }

        if(incorrectFormat(correo)){
            //escribir error
            return false;
        }

        if(!pass.match(/^.{8,}$/)){

        }
    }

    /**
     * Function to verify if array has empty elements
     * @param {*} array to check for empty elements
     * @returns true if there is an empty element, false otherwise
     */
    function emptyValues(array){
        array.forEach(function(value){
            if(!value.value){
                console.log("ERROR VALORES VACIOS");
                return true;
            }
        });
        return false;
    }

    /**
     * Function to verify if email is in a valid format
     * @param {*} correo the email to verify
     * @returns true if the email is in an invalid format, false otherwise
     */
    function incorrectFormat(correo){
        if(correo.match(/^.+@.*\..{2,}$/)){
            console.log("ERROR CORREO FORMATO INCORRECTO");
            return false;
        }
        return true;
    }
});