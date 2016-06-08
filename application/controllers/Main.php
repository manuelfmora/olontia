<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que muestra la vista al iniciar la aplicación.
 * Muestra todas los Productos seleccionados en distintas páginas.
 */
class Main extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('Descuentos');       
        $this->load->library('pagination');
        $this->load->model('M_Cd'); 
        $this->load->library('L_Cart', 0, 'myCart');
    }
    /**
     * Muestra todas los Productos seleccionados
     * @param Int $desde Posición desde la que empieza a paginar
     */
    public function index($desde = 0) {        
        
        $config = $this->getConfigPag();

        
        $this->pagination->initialize($config);
        
        $seleccionados = $this->M_Cd->getSeleccionados($config['per_page'], $desde); //Conseguimos los artículos seleccionados
        $banner=$this->M_Cd->getBanner();
        $cuerpo = $this->load->view('V_Inicio', Array(
                                                      'seleccionados' => $seleccionados,
                                                      'banner' =>$banner), true); //Generamos la vista       
        
        $this->load->view('V_Plantilla', Array(
                                                'cuerpo' => $cuerpo, 
                                                'homeactive' => 'active'));
    }
    
    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    public function getConfigPag(){
        //Configuración de Paginación
        $config['base_url'] = site_url('/Main/index');
        $config['total_rows'] = $this->M_Cd->getNumTotalProductosSeleccionados();       
        $config['per_page'] = $this->config->item('per_page_seleccionadas');
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="pag_activa"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li title="Anterior">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li title="Siguiente">';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['first_tag_open'] = '<li title="Inicio">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li title="Final">';
        $config['last_tag_close'] = '</li>';

    
        return $config;
    }
    
}

