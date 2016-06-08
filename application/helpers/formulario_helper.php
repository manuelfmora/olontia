<?php

/**
 * Función que devuelve una lista desplegable/select.
 * @param array $datos Los datos que va a contener la lista desplegable.
 * @param string $name El nombre del select.
 * @return string Código html generado.
 */
function CreaSelect($datos, $name) {

    $datos = CreaArrayParaSelect($datos);
    $html = '<select class="country_to_state country_select" id="billing_country" name="' . $name . '">';

    foreach ($datos as $idx => $texto) {
        $html.= "<option value='$idx' " . set_select($name, $idx) . " >$texto</option>";
    }

    $html.= '</select>';

    return $html;
}

/**
 * Función que devuelve una lista desplegable/select con un elemento seleccionado.
 * @param array $datos Los datos que va a contener la lista desplegable.
 * @param string $opcSelected Elemento saldrá seleccionado.
 * @return string Código html generado.
 */
function CreaSelectMod($datos, $name, $opcSelected) {

    $datos = CreaArrayParaSelect($datos);
    $html = '<select class="country_to_state country_select" id="billing_country" name="' . $name . '">';

    foreach ($datos as $idx => $texto) {
        $html.= "<option value=$idx ";

        if ($idx == $opcSelected)//Si es igual a la provincia que tiene guardada, la seleccionamos
            $html.= "selected = selected";

        $html.= " >$texto</option>";
    }

    $html.= '</select>';

    return $html;
}

/**
 * Función que devuelve un array correcto para formar una lista desplegable.
 * @param array $array
 * @return array Array correcto.
 */
function CreaArrayParaSelect($array) {
    $nuevoArray = array();

    foreach ($array as $key => $value) {
        $nuevoArray[$value['cod']] = $value['nombre'];
    }

    return $nuevoArray;
}


/**
 * Cambia el formato de una fecha
 * @param Date $fecha Fecha a cambiar
 * @return Date Fecha cambiada
 */
function cambiaFormatoFecha($fecha){
    $date = date_create($fecha);
    
    return date_format($date, 'd/m/Y');
}

/**
 * Devuelve la letra que le corresponde a un DNI.
 * @param string $dni Números del DNI.
 */
function dni_LetraNIF($dni)
{
	return mb_substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($dni, 0, 8) % 23, 1);
}

/**
 * Función que devuelve si dos claves son iguales.
 * @param string $clave Primera clave.
 * @param string $clave_rep Segunda clave.
 * @return boolean
 */
function claves_check($clave, $clave_rep) {
        
       if($clave == $clave_rep)
       {
           return TRUE;
       }
       else{
           return FALSE;
       }
   }
   
    
