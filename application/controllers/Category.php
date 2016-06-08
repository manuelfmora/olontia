<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR en el que se puede elegir la categoría a mostrar con las productos paginados.
 */
class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('M_Categories');
        $this->load->model('M_Cd');
        $this->load->library('L_Cart', 0, 'myCart');
    
    }

    /**
     * Muestra todas los productos de una categoría
     * @param Int $idCat ID de la categoría
     * @param Int $desde Posición de donde tiene que empezar a paginar
     */

    public function ver($idCat = 1, $desde = 0) {
      
        //Configuración de Paginación
        $config = $this->getConfigPag($idCat);

        $this->pagination->initialize($config);

        $unaCategoria = $this->M_Categories->getUnaCategoria($idCat);

        $categorias = $this->M_Categories->getCategorias();
        $banner=$this->M_Cd->getBanner();

        //Conseguimos los productos de la categoría seleccionada
        $productos = $this->M_Categories->getProductosFromCategoria($idCat, $config['per_page'], $desde);

            $cuerpo = $this->load->view('V_Category', Array('categoriaactive' => 'active', 
                                                         'titulo' => $unaCategoria['descripcion'],
                                                          'banner' =>$banner,
                                                          'unaCategoria' => $unaCategoria, 
                                                          'productos' => $productos), true);

        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo));
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @param Int $idCat ID de la categoría
     * @return Array Configuración
     */
    function getConfigPag($idCat) {
        
        $config['base_url'] = site_url('/Category/ver/' . $idCat . '/');
        $config['total_rows'] = $this->M_Categories->getNumTotalProductosFromCategoria($idCat);
        $config['num_links'] = 1;
        $config['per_page'] = $this->config->item('per_page_categorias');
        $config['uri_segment'] = 4;
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
