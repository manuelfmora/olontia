<?php

/**
 *  MODELO de la consultas relacionadas con el carrito.
 *
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cart extends CI_Model{
    
    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve los datos de una producto para usarlo en el carrito
     * @param Int $id ID de la producto
     * @return Array
     */
    public function getDataProducto($id) {
      
        $query = $this->db->query("SELECT idProducto, precio, descuento, nombre_pro, imagen "
                                    . "FROM producto "
                                    . "WHERE idProducto = $id; ");
        
        return $query->row_array();
    }
    
    /**
     * Devuelve el stock de una producto
     * @param Int $id ID de la producto
     * @return Int
     */
    public function getStock($id){
        $query = $this->db->query("SELECT stock "
                                    . "FROM producto "
                                        . "WHERE idProducto = $id; ");
                               
        return $query->row_array()['stock'];
        
    }
}
