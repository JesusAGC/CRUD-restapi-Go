function validar() {
    var regex_curp =  /^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/;
    var nombre = document.getElementById("f_nombre").value.trim();
    var nombrec = document.getElementById("f_nombrec").value.trim();
    var paterno = document.getElementById("f_paterno").value.trim();
    var curp = document.getElementById("f_curp").value.trim();

    if (nombrec.length<15) {
        alert("Muy corto, escriba un nombre completo válido");
        return false;
    }
    
    if (nombre.length<2) {
        alert("Muy corto, escriba un nombre válido");
        return false;
    }

    if (paterno.length<2) {
        alert("Muy corto, escriba un apellido válido");
        return false;
    }

    // if(regex_curp.test(curp)==false){
    //     alert("Error: El CURP no cumple con el formato, consulte su curp en https://www.gob.mx/curp/");
    //     return false;
    // }
}
