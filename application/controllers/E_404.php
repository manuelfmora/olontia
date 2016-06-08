<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class E_404 extends CI_Controller {
    
    public function __construct() {
      parent::__construct();        
      $this->load->library('L_Cart', 0, 'myCart');
    }
   public function index(){
       
        $cuerpo = $this->load->view('V_404', Array(), true);
        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo,                                              
                                                'carritoactive' => 'active'));
   }
}