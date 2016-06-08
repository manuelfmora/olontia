<?php

/**
 * Description of Coins
 * Gestiona el cambio de monedas.
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Coins extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('L_Cart', 0, 'myCart');
    }
    /**
     * Cambia en la sesión la moneda
     * @param Float $rate Valor de la moneda
     * @param Float $currency Nombre de la moneda
     */
    public function Cambio($rate, $currency) {
        $currency1=  trim($currency,'&nbsp;&nbsp;');
        
        $datos = array(
            'rate' => $rate,
            'currency' => $currency1
        );
        $this->session->set_userdata($datos);
        
        $url = $this->session->userdata('URL');
        redirect($url, 'location', 301); 
    }
}
