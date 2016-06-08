<?php

/**
 * MODELO que gestiona los pedidos
 */
class M_Pedidos extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->model('M_cart');
    }

    /**
     * Añade un pedio a la base de datos
     * @param Array $dataPedido Datos del pedido
     * @return Int ID del pedido insertado
     */
    public function insertPedido($dataPedido) {
        $this->db->insert('pedido', $dataPedido);

        return $this->db->insert_id();
    }

    /**
     * Añade una línea de pedido a la base de datos
     * @param Array $data Datos de la línea de pedido
     */
    public function insertLineaPedido($data) {
        $this->db->insert('linea_pedido', $data);
    }

    /**
     * Consulta los datos necesarios del usuario para hacer el pedido
     * @param Int $id ID del usuario
     * @return Array
     */
    public function getDatosParaPedido($id) {
        $query = $this->db->query("SELECT direccion, cp, cod_provincia, correo "
                . "FROM usuario "
                . "WHERE idUsuario = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta los datos necesarios del usuario para crear el documento PDF
     * @param Int $id ID del usuario
     * @return Array
     */
    public function getDatosParaPDF($id) {
        $query = $this->db->query("SELECT nombre_persona, apellidos_persona, dni, direccion, cp, p.nombre 'provincia' "
                . "FROM usuario u "
                . "INNER JOIN provincias p on u.cod_provincia = p.cod "
                . "WHERE idUsuario = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta el IVA de un producto
     * @param Int $id ID del producto
     * @return Float
     */
    public function getIva($id) {
        $query = $this->db->query("SELECT iva "
                . "FROM producto "
                . "WHERE idProducto = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta un pedido de un usuario
     * @param Int $id ID del pedido
     * @param Int $iduser ID del usuario
     * @return Array
     */
    public function getPedido($id, $iduser) {
        $query = $this->db->query("SELECT importe, cantidad_total, estado, fecha_pedido, importeiva "
                . "FROM pedido "
                . "WHERE idPedido = $id "
                . "AND idUsuario = $iduser; ");

        return $query->row_array();
    }

    /**
     * Consulta los datos de envío de un pedido
     * @param Int $id ID del pedido
     * @return Array
     */
    public function getDatosEnvio($id) {
        $query = $this->db->query("SELECT direccion, cp, cod_provincia  "
                . "FROM pedido "
                . "WHERE idPedido = $id; ");

        return $query->row_array();
    }

    /**
     * Consulta todas las líneas de pedido que tiene un pedido
     * @param Int $id ID del pedido
     * @return Array 
     */
    public function getLineasPedidos($id) {

        $query = $this->db->query("SELECT prod.imagen, prod.descripcion, prod.nombre_pro, cantidad, li.precio, importe, li.iva  "
                . "FROM linea_pedido li "
                . "INNER JOIN producto prod on li.idProducto = prod.idProducto "
                . "WHERE li.idPedido = $id; ");

        return $query->result_array();
    }

    /**
     * Disminuye el stock de un producto cuando se realiza la compra
     * @param Int $idProducto ID delproducto
     * @param Int $cantidad Cantidad a disminuir
     */
    public function CambiaStock($idProducto, $cantidad) {
        $stock = $this->M_Cart->getStock($idProducto);

        $stock = $stock - $cantidad;

        $data = array(
            'stock' => $stock
        );
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }
    
    /**
     * Consulta los datos de un nombre de usuario
     * @param String $username Nombre de usuario
     * @return Array
     */
    public function getDatosFromUserName($username) {

        $query = $this->db->query("SELECT idUsuario 'id', dni, nombre_persona 'nombre', correo "
                . "FROM usuario "
                . "WHERE nombre_usu LIKE '$username'; ");

        return $query->row_array();
    }

}
