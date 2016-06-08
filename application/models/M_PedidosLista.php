<?php

/**
 * Description of M_PedidosLista
 *
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_PedidosLista extends CI_Model{
    public function __construct() {
        $this->load->database();
        $this->load->model('M_Cart');
    }

    /**
     * Devuelve todos los pedidos de un usuario
     * @param Int $iduser ID del usuario
     * @return Array Datos
     */
    public function getPedidos($iduser) {
        $query = $this->db->query("SELECT *, pr.nombre 'nom_provincia' "
                . "FROM pedido pe "
                . "INNER JOIN provincias pr on pr.cod = pe.cod_provincia "
                . "WHERE idUsuario = $iduser ");

        return $query->result_array();
    }

    /**
     * Devuelve número de pedidos de un usuario
     * @param Int $iduser ID del usuario
     * @return Int Nº pedidos
     */
    public function getCountPedidos($iduser) {
        $query = $this->db->query("SELECT count(*)cont "
                . "FROM pedido "
                . "WHERE idUsuario = $iduser; ");

        return $query->row_array()['cont'];
    }

    /**
     * Devuelve el estado de un pedido
     * @param Int $idpedido ID del pedido
     * @return String Estado
     */
    public function getEstado($idpedido) {
        $query = $this->db->query("SELECT estado "
                . "FROM pedido "
                . "WHERE idPedido = $idpedido; ");

        return $query->row_array()['estado'];
    }

    /**
     * Establece un pedido nulo, es decir, cambia su estado a 'Anulado'
     * @param Int $idPedido ID del pedido
     */
    public function setAnulado($idPedido) {
        $data = array(
            'estado' => 'Anulado'
        );
        $this->db->where('idPedido', $idPedido);
        $this->db->update('pedido', $data);
    }

    /**
     * Devuelve la cantidad de productos de un pedido.
     * @param Int $idPedido ID del pedido
     * @return Array
     */
    public function getCantidad($idPedido) {
        

        $query = $this->db->query("SELECT cantidad, idProducto  "
                . "FROM linea_pedido "
                . "WHERE idPedido = $idPedido; ");
       
        return $query->result_array();
    }

    /**
     * Actualiza el stock de un producto después de anular un pedido
     * @param Int $idProducto 
     * @param Int $cantidad Cantidad a actualizar
     */
    public function CambiaStock($idProducto, $cantidad) {
        $stock = $this->M_Cart->getStock($idProducto);

        $stock = $stock + $cantidad;

        $data = array(
            'stock' => $stock
        );
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }

}
