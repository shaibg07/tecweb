var form=document.getElementById("formularioProductos"); 
var mensaje1='', mensaje2='', mensaje3='', mensaje4='', mensaje5='', mensaje6='', mensaje7=''; 

function validar_nombre(){
    let entrada = document.getElementById("form-nombre").value;
    let sinErrores = true; 
    if(entrada.trim()==="" || entrada.length > 100){
        mensaje1 = "El campo de nombre no puede estar vacío y debe tener máximo 100 caracteres."; 
        sinErrores = false; 
    }
    return sinErrores; 
}