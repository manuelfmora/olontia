<?php
/*
 * HELPER que contiene una función que nos dice si se ha iniciado sesión o no.
 */

/**
 * Función que devuelve si se ha iniciado sesión en la aplicación.
 * @return boolean
 */
function SesionIniciadaCheck() {    
    $CI = get_instance();
    if ($CI->session->userdata('logged_in')) {
        return TRUE;
    } else {
        return FALSE;
    }
}
