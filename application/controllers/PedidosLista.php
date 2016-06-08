<?php

/**
 * Description of PedidosLista
 * 
 * CONTROLADOR que muestra los pedidos del usuario pudiendo anularlo.
 *
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class PedidosLista extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('M_PedidosLista');
        $this->load->model('M_Provincias');
        $this->load->library('L_Cart', 0, 'myCart');
        $this->load->helper('Formulario');
        $this->load->library('pagination');
    }

    /**
     * Muestras todos los pedidos del usuario loagueado en forma de tabla
     */
    public function ver() {

        $pedidos = $this->M_PedidosLista->getPedidos($this->session->userdata('userid'));
        $numPedidos = $this->M_PedidosLista->getCountPedidos($this->session->userdata('userid'));

        if ($numPedidos == 0) {
            $cuerpo = $this->load->view('V_ElistaPedido', Array(), true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));

            return;
        } else if (!$pedidos) {
            redirect("Error404", "Location", 301);
            return;
        }

        $cuerpo = $this->load->view('V_PedidosLista', Array('pedidos' => $pedidos), true);
        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));
    }

    /**
     * Anula un pedido si se puede sino muestra un mensaje de error
     * @param Int $idPedido ID del pedido
     */
    public function AnularPedido($idPedido) {
        
        $msg_error = '';
        $pedidos = $this->M_PedidosLista->getPedidos($this->session->userdata('userid'));

        $estado = $this->M_PedidosLista->getEstado($idPedido);

        if (!$pedidos) {
            redirect('Error404', 'Location', 301);
            return;
        }

        if ($estado == 'Pendiente') {
            $this->M_PedidosLista->setAnulado($idPedido);
            $this->SubeStock($idPedido);
            redirect('/PedidosLista/ver', 301, 'Location');
            return;
        } else if ($estado == 'Anulado') {
            $msg_error = '<div class="alert alert-danger"> <b> ¡Error! </b> El pedido ya está anulado</div>';
        } else if ($estado == 'Procesado') {
            $msg_error = '<div class="alert alert-danger"> <b> ¡Error! </b> El pedido ya está procesado, no se puede anular</div>';
        } else if ($estado == 'Recibido') {
            $msg_error = '<div class="alert alert-danger"> <b> ¡Error! </b> El pedido ya ha sido recibido, no se puede anular</div>';
        } else {
            redirect('Error404', 'Location', 301);
        }

        $cuerpo = $this->load->view('V_PedidosLista', Array(
                                                             'pedidos' => $pedidos, 
                                                             'msg_error' => $msg_error), true);
        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Mis Pedidos', 'homeactive' => 'active'));
    }

    /**
     * Sube la cantidad de stock de los productos de un pedido después de anularlo
     * @param type $idPedido
     */
    public function SubeStock($idPedido) {
        
        $lineaPedidos = $this->M_PedidosLista->getCantidad($idPedido);
        
        foreach ($lineaPedidos as $key => $value) {
                   
           $this->M_PedidosLista->CambiaStock($value['idProducto'], $value['cantidad']);
            
        }
    }

    /**
     * Establece y devuelve la configuración de la paginación
     * @return Array Configuración
     */
    public function getConfigPag() {
        //Configuración de Paginación
        $config['base_url'] = site_url('/MisPedidos/ver');
        $config['total_rows'] = $this->M_PedidosLista->getCountPedidos($this->session->userdata('userid'));
        //$config['num_links'] = 6;
        $config['per_page'] = 10;
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
