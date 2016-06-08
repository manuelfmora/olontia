<?php

/**
 * Description of M_Provincias
 *
 * @author Manuel Mora
 */
class M_Provincias extends CI_Model{
    
     public function __construct() {
        $this->load->database();
    }

    /**
     * Consulta todas las provincias
     * @return Array
     */
    public function getProvincias() {

        $query = $this->db->query("SELECT cod, nombre "
                                    . "FROM provincias ");
        
        return $query->result_array();
    }      
    
    /**
     * Consulta el nombre de una provincia
     * @param Int $cod Código de la provincia
     * @return String Nombre de la provincia
     */
    public function getNombreProvincia($cod) {

        $query = $this->db->query("SELECT nombre "
                                 . "FROM provincias "
                                 . "WHERE cod = $cod");
        
        return $query->result_array()[0]['nombre'];
    }

}
