var mensaje = ['Ni números ni caracteres especiales', 'Introduce un email válido', 'Introduce un mensaje menor de 500 caracteres con un mínimo de 2 caracteres', 'Debes aceptar los terminos y condiciones'];
var objetos = null;
function crearAviso(msj, pos){
    objetos = document.createElement("DIV");
    var t = document.createTextNode(msj);

    objetos.appendChild(t);
    objetos.className = "error-msj";
    objetos.style.top = pos+"px";
    document.body.appendChild(objetos);
}

function destruirAviso(){
    document.body.removeChild(objetos);
    objetos = null;
}

function validar(event){
    var form = document.forms[0];
    var l = form.length-1;
    var n = 612;
    if(objetos != null){
        destruirAviso(objetos);
    }
    for(var i = 0; i<=l; i++){
        if(!form[i].validity.valid){
            crearAviso(mensaje[i], n);
            event.preventDefault();
            break;
        }

        n+=95;
    }
}