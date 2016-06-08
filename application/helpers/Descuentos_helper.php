<?php
/*
 * HELPER que contiene funciones relacionadas con el precio y el descuento
 */

/**
 * Función que muestra el precio y el descuento de una Producto. 
 * Si tiene descuento aparece el precio tachado con la etiqueta <del> y el precio con el descuento sin tachar. 
 * @param float $precio
 * @param float $descuento
 */
function MostrarDescuento($precio, $descuento) {
    $CI = get_instance();
    
    if ($CI->session->userdata('rate')){
        $rate = $CI->session->userdata('rate');
        $currency = $CI->session->userdata('currency');
    }
    else
    {
//        'currency' => 'EUR &nbsp;&nbsp;'
        $datos = array(
            'rate' => 1,
            'currency' => 'EUR'
        );
        $CI->session->set_userdata($datos);
        
        $rate = 1;
        $currency = 'EUR';
    }
    
    if ($descuento != '0.00') {
        echo "<ins>". round($precio *(1 - ($descuento/100)) * $rate, 2);
        
        echo " ".$currency;
        echo "</ins>";
        echo "<del>".round($precio * $rate, 2) ." $currency</del>";
    } else { //No tiene descuento, solo se meustra el precio
        echo "<ins>".round($precio * $rate, 2) ." $currency</ins>";
    }
}

/**
 * Función que te devuelve el precio final de una Producto según su descuento.
 * @param float $precio Precio de la Producto.
 * @param float $descuento Descuento que tiene la Producto, sino tiene será 0.
 * @return float Precio final calculado.
 */
function getPrecioFinal($precio, $descuento){
    return ($precio *(1 - ($descuento/100)));
}
