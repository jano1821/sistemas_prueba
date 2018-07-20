function cambiarFormaDePago($formaDePago,$confirmacion){
    if($confirmacion == true){
        if(confirm('Se perderan todos los cambios realizados en el Carrito De Compras. Desea continuar?'))      {
            window.location.href='prenda.php?section=5&formaPago='+$formaDePago;
        }
    }else{
        window.location.href='prenda.php?section=5&formaPago='+$formaDePago;
    }
}

function cambiarFormaDePagoDesdeVentas($formaDePago,$confirmacion){
    if($confirmacion == true){
        if(confirm('Se perderan todos los cambios realizados en el Carrito De Compras. Desea continuar?')){
            window.location.href='ventas.php?section=6&action=listaInicial&formaPago='+$formaDePago;
        }
    }else{
        window.location.href='ventas.php?section=6&action=listaInicial&formaPago='+$formaDePago;
    }

}


function confirmDelete($texto,$urlDestino){
    if($urlDestino == '') return false;
    if($texto == ''){
        $msj = 'Se van a eliminar datos, desea continuar?';
    }else{
        $msj = "Esta seguro de eliminar "+$texto+"?";
    }
    if(confirm($msj)){
        //alert($urlDestino);
        window.location.href=$urlDestino;
    }
    return false;
}

function confirmCarrito($texto,$urlDestino){
    if($urlDestino == '') return false;
    if($texto == '') $texto = 'Esta seguro de realizar esta accion?';
    if(confirm($texto)){
        //alert($urlDestino);
        window.location.href=$urlDestino;
    }
    return false;
}

function facturar($urlDestino){
    if($urlDestino == '') return false;
    $texto = 'Se va a facturar y a vaciar la lista del Carrito de Compras. Desea continuar?';
    if(confirm($texto)){
        if(document.getElementById('descontar_iva').checked){
            $urlDestino = $urlDestino + '&descontar_iva=true';
        }else{
            $urlDestino = $urlDestino + '&descontar_iva=false';
        }
        if(document.getElementById('sumar_ganancia').checked){
            $urlDestino = $urlDestino + '&sumar_ganancia=true';
        }else{
            $urlDestino = $urlDestino + '&sumar_ganancia=false';
        }
        window.location.href=$urlDestino;
    }
    return false;
}

function cambiarVisibilidadGanancia(){
    if(document.getElementById('descontar_iva').checked){
        document.getElementById('th_sumar_ganancia').style.display = 'block';
    }else{
        document.getElementById('th_sumar_ganancia').style.display = 'none';
    }
}

function cambiarUnidades($cantidad,$modo){
    for($x=1; $x<=$cantidad; $x++){
        document.getElementById('medida'+$x).innerHTML = $modo;
    }
}

function agregarPrenda($prenda){
    document.getElementById('cantPrendasAgregadas').value = $prenda;
    document.getElementById('prenda_num_'+$prenda).style.display = 'block';
}

