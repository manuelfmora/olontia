<?php
/*
 * HELPER que gestiona el cambio en la moneda
 */

/**
 * Muestra una lista con las monedas disponibles para poder cambiar
 * @return String HTML generado
 */
function MuestraMonedas() {
    
    $XML = getFicheroXML_Monedas();
    $html = '<div class="aa-currency">';
    $html.= '<div class="dropdown">';
    $html.= '<a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">';
    $html.= '<i class="fa fa-eur"></i>Monedas';
    $html.= '<span class="caret"></span>';
    $html.= '</a>';
    $html.= '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
    $html.='<li><a href = "'. site_url() .'/Coins/Cambio/1/EUR">EUR</a></li>';
    foreach ($XML->Cube->Cube->Cube as $rate) {
        $html.='<li><a href = "'.site_url().'/Coins/Cambio/'.$rate['rate']."/".$rate['currency'].'">'.$rate['currency'].'</a></li>';
    }
    $html.='</ul>';
    $html.='</div>';
    $html.=' </div>';    
    return $html;
}
/**
 * Devuelve el XML que contiene las monedas, sino está guardado con la fecha actual lo crea.
 * @return XML
 */
function getFicheroXML_Monedas(){
    
    $fecha = date('d-m-Y');

    $nombreFichero = "././assets/coins/" . $fecha . "monedas.xml";

    if (file_exists($nombreFichero)) {//Si existe el fichero lo carga en XML
        $XML = simplexml_load_file($nombreFichero);
    } else {//Sino, guarda el archivo y lo carga en XML
        $contenido = file_get_contents("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");

        file_put_contents($nombreFichero, $contenido); //Guarda el fichero xml en el equipo

        $XML = simplexml_load_file($nombreFichero);
    }
    
    return $XML;
}
