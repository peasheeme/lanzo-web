var mensaje = ['Ni números ni caracteres especiales', 'Introduce un email válido', 'Introduce un mensaje menor de 500 caracteres'];
var objetos = null;
function crearAviso(msj, pos){
    objetos = document.createElement("div");
    var t = document.createTextNode(msj);

    objetos.appendChild(t);
    objetos.className = 'error-msj';
    objetos.style.top = pos+"px";
    document.body.appendChild(objetos);
}

function destruirAviso(){
    document.body.removeChild(objetos);
    objetos = null;
}

function validar(event){
    var form = document.form[0];
    var l = form.length-1;
    var n = 210;
    if(objetos != null){
        destruirAviso(objetos);
    }
    for(var i = 0; i<=1; i++){
        if(!form[i].validity.valid){
            crearAviso(mensaje[i], n);
            event.preventDefault();
            break;
        }

        n+=50;
    }
}