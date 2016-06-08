<?php

/**
 * Description of M_RestaurarClave
 *
 * @author Manuel Mora
 */


class M_RestaurarClave  extends CI_Model{
     public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta los datos de un usuario dando su nombre de usuario
     * @param String $username Nombre del usuario
     * @return Array
     */
    public function getDatosFromUserName($username) {

        $query = $this->db->query("SELECT idUsuario 'id', dni, nombre_persona 'nombre', correo "
                . "FROM usuario "
                . "WHERE nombre_usu LIKE '$username'; ");

        return $query->row_array();
    }

    /**
     * Consulta los datos de un usuario dando su ID de usuario
     * @param Int $id ID de usuario
     * @return Array
     */
    public function getDatosFromId($id) {

        $query = $this->db->query("SELECT idUsuario 'id', dni, nombre_persona 'nombre', nombre_usu 'username', correo "
                . "FROM usuario "
                . "WHERE idUsuario LIKE '$id'; ");

        return $query->result_array()[0];
    }

    /**
     * Actualiza la clave de usuario
     * @param String $username Nombre de usuario
     * @param String $clave Contraseña encriptada
     */
    public function UpdateClave($username, $clave) {
        $data = array(
            'clave' => $clave
        );
        $this->db->where('nombre_usu', $username);
        $this->db->update('usuario', $data);
    }

}
