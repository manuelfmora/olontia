<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra una vista cuando no se ha iniciado sesión en determinadas funciones como cuandono se ha iniciado sesión y se quiere finalizar la compra.
 */
class Sessionnull extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('L_Cart', 0, 'myCart');
    }

    /**
     * Muestra la vista de sesión no iniciada
     */
    public function index() {
        $cuerpo = $this->load->view('V_sessionnull', Array(), true);
        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Sesión no iniciada', 'carritoactive' => 'active'));
    }

}
