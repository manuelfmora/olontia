<?php

/**
 * MODELO de la consultas relacionadas con la tabla categoría.
 */
class M_Categories extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve toda las categorías que se puedan mostrar
     * @return Array
     */
    public function getCategorias() {

        $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1; ");

        return $query->result_array();
    }

    /**
     * Devuelve una categoría
     * @param ID $idCategoria ID de la categoría
     * @return Array
     */
    public function getUnaCategoria($idCategoria) {

        $query = $this->db->query("SELECT idCategoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1 "
                . "AND idCategoria = $idCategoria ");


        return $query->row_array();
    }

    /**
     * Devuelve los producto que se puedan mostrar de una categoría
     * @param Int $idCategoria ID de la cantegoría
     * @param Int $limit Hasta donde te devuelve
     * @param Int $start Desde donde te devuelve
     * @return Array
     */
    public function getProductosFromCategoria($idCategoria, $limit, $start) {

        $query = $this->db->query("SELECT idProducto, nombre_pro, descripcion, imagen, precio, descuento, seleccionado "
                . "FROM producto "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCategoria = $idCategoria "
                . "AND seleccionado <> 2 "
                . "AND stock > 0 "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Devuelve el número de productosque tiene una categoria
     * @param Int $idCategoria ID de la categoría
     * @return Int Nº productos
     */
    public function getNumTotalProductosFromCategoria($idCategoria) {
        $query = $this->db->query("SELECT idProducto "
                . "FROM producto "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCategoria = $idCategoria "
                . "AND seleccionado <> 2 "
                . "AND stock > 0 ");
        return $query->num_rows();
    }

}
