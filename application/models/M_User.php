<?php

/**
 * Description of M_User
 *
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class M_User extends CI_Model{
    
    public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta el número de usuarios que tienen el mismo nombre que el pasado por parámetro
     * @param String $nombre_usu Nombre de usuario
     * @return Int Nº de usuarios
     */
    public function getCount_NombreUsuario($nombre_usu) {
     
        $query = $this->db->query("SELECT * "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu' ");
      
        return $query->num_rows();
    }

    /**
     * Añade un usuario a la base de datos
     * @param Array $data Datos del usuario
     */
    public function addUsuario($data) {

        $this->db->insert('usuario', $data);
    }

    /**
     * Consulta la contraseña del usuario
     * @param String $username Nombre de usuario
     * @return String Contraseña codificada
     */
    public function getClave($username) {

        $query = $this->db->query("SELECT clave "
                . "FROM usuario "
                . "WHERE nombre_usu = '$username'; ");

        return $query->row_array()['clave'];
    }

    /**
     * Cambia el estado de un usuario a 'B', baja
     * @param String $username Nombre de usuario
     */
    public function setBajaUsuario($username) {
        $data = array(
            'estado' => 'B'
        );
        $this->db->where('nombre_usu', $username);
        $this->db->update('usuario', $data);
    }
    
    /**
     * Consulta los datos que se van a modificar para mostrarlos en el formualario
     * @param String $nombre_usu Nombre de usuario
     * @return Array
     */
    public function getDatosModificar($nombre_usu) {

        $query = $this->db->query("SELECT idUsuario, nombre_usu, correo, direccion, cp, cod_provincia "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu'");
                   
        return $query->row_array();
    }
    
    /**
     * Consulta el número de usuario que tienen el nombre de usuario pasado por parámetro y no es el ID pasado por parámetro
     * @param String $nombre_usu Nombre de usuario
     * @param Int $idUsuario ID de usuario
     * @return Int Nº de usuarios
     */
    public function getCount_NombreUsuarioModificar($nombre_usu, $idUsuario) {

        $query = $this->db->query("SELECT * "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu' "
                . "AND idUsuario != $idUsuario; ");

        return $query->num_rows();
    }
    
        /**
     * Consulta 
     * @param String $username Nombre de usuario
     * @param String $clave Clave usuario
     * @return Int Nº de usuarios
     */
    public function getEstado($username) {
        
        $query = $this->db->query("SELECT estado "
                . "FROM usuario "
                . "WHERE nombre_usu = '$username' "
                . "AND estado = 'A' ;"
                );   
        return $query->num_rows();
    }
    
    /**
     * Consulta el id de usuario a través de su nombre de usuario
     * @param String $nombre_usu Nombre de usuario
     * @return Int ID de usuario
     */
    public function getId($nombre_usu) {

        $query = $this->db->query("SELECT idUsuario "
                . "FROM usuario "
                . "WHERE nombre_usu = '$nombre_usu' ");

        return $query->row_array()['idUsuario'];
    }
    
    /**
     * Actualiza los datos de un usuario
     * @param Int $id ID de usuario
     * @param Array $data Datos de la actualización
     */
    public function updateUsuario($id,$data) {
        $this->db->where('idUsuario', $id);
        $this->db->update('usuario', $data);
    }
}
