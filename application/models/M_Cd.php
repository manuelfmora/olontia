<?php

/**
 * Description of M_Cd
 * Modelo de las consultas de los productos.
 * @author Manuel Mora
 */
class M_Cd extends CI_Model{
    
    public function __construct() {
       $this->load->database();
    }

    /**
     * Devuelve los datos de un cd
     * @param Int $idProducto ID de la producto
     * @return Array 
     */
    public function getProducto($idProducto) {

        $query = $this->db->query("SELECT idProducto, idCategoria, cod_producto, nombre_pro, descripcion, imagen, precio, descuento,stock "
                . "FROM producto "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idProducto = $idProducto "
                . "AND stock > 0 ");

        return $query->row_array();
    }

    /**
     * Devuelve la información de una categoría
     * @param Int $idCategoria ID de la categoría
     * @return Array
     */
    public function getInfoCategoriaFromProducto($idCategoria) {
        $query = $this->db->query("SELECT idCategoria, cod_categoria, nombre_cat, descripcion "
                . "FROM categoria "
                . "WHERE mostrar = 1 "
                . "AND idCategoria = $idCategoria; ");

        return $query->row_array();
    }

    /**
     * Función que dice si una producto se debe mostrar
     * @param Int $idProducto ID de la producto
     * @return boolean
     */
    public function SiSeDebeMostarProducto($idProducto) {

        $query = $this->db->query("SELECT count(*) as cont "
                . "FROM producto "
                . "WHERE idProducto = $idProducto ");

        $cont = $query->row_array()['cont'];

        if ($cont > 0) {//Existe el idproducto
            $query2 = $this->db->query("SELECT cat.mostrar 'mostrarcat', pro.mostrar 'mostrar', stock "
                    . "FROM producto pro "
                    . "INNER JOIN categoria cat on pro.idCategoria = cat.idCategoria "
                    . "WHERE idProducto = $idProducto ");

            $datos = $query2->row_array();

            if ($datos['mostrarcat'] == 1 && $datos['mostrar'] == 1 && $datos['stock'] > 0)//Se debe mostrar el producto
                return true;
            else {
                return false;
            }
        } else//No existe el idproducto
            return false;
    }

    /**
     * Devuelve los productos relacionados con su categoría 
     * @param Int $idCategoria ID de la categoría
     * @param Int $idProducto ID producto
     * @return Array
     */
    public function getProductosRelacionadasFromCategoria($idCategoria, $idProducto) {

        $query = $this->db->query("SELECT idProducto, descripcion, imagen, precio, descuento "
                . "FROM producto "
                . "WHERE mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND idCategoria = $idCategoria "
                . "AND idProducto != $idProducto "
                . "AND stock > 0 ");

        return $query->result_array();
    }
         /**
     * Consulta los productos seleccionados que se puedan mostrar
     * @param Int $limit Hasta el registro que debe devolver
     * @param Int $start Desde donde debe devolver
     * @return Array
     */
    public function getBanner() {

        
        $query = $this->db->query("SELECT pro.nombre_pro, pro.idProducto, pro.descripcion, pro.imagen, pro.precio, pro.descuento, pro.seleccionado "
                . "FROM producto pro "
                . "INNER JOIN categoria cat on pro.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND pro.seleccionado = 2 "
                . "AND pro.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND stock > 0 ; ");

        return $query->result_array();
    }
     /**
     * Consulta los productos seleccionados que se puedan mostrar
     * @param Int $limit Hasta el registro que debe devolver
     * @param Int $start Desde donde debe devolver
     * @return Array
     */
    public function getSeleccionados($limit, $start) {

        
        $query = $this->db->query("SELECT pro.nombre_pro, pro.idProducto, pro.descripcion, pro.imagen, pro.precio, pro.descuento, pro.seleccionado "
                . "FROM producto pro "
                . "INNER JOIN categoria cat on pro.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND pro.seleccionado = 1 "
                . "AND pro.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND stock > 0 "
                . "LIMIT $start, $limit; ");

        return $query->result_array();
    }

    /**
     * Consulta el número de productos selecciondos que se pueden mostrar
     * @return Int Nº productos
     */
    public function getNumTotalProductosSeleccionados() {
        $query = $this->db->query("SELECT pro.idProducto "
                . "FROM producto pro "
                . "INNER JOIN categoria cat on pro.idCategoria = cat.idCategoria "
                . "WHERE cat.mostrar=1 "
                . "AND pro.seleccionado = 1 "
                . "AND pro.mostrar = 1 "
                . "AND curdate() >= fecha_inicio "
                . "AND curdate() <= fecha_fin "
                . "AND stock > 0 ");

        return $query->num_rows();
    }

}




    

