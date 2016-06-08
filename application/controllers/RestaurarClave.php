<?php

/**
 * Description of RestaurarClave
 *
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class RestaurarClave extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('L_Cart', 0, 'myCart');
        $this->load->library('form_validation');
        $this->load->model('M_User');
        $this->load->model('M_RestaurarClave');
        $this->load->library('email');
        $this->load->helper('Formulario');
    }

    /**
     * Muestra el formulario que pide el nombre de usuario para enviar el correo, si el usuario no existe muestra un mensaje de error y si existe se envia el correo y muestra un mensaje de éxito.
     */
    public function index() {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('ExisteUsuario_check', 'No existe el usuario introducido');
        $this->form_validation->set_rules('username', 'nombre de usuario', 'required|callback_ExisteUsuario_check');

        if ($this->form_validation->run() == FALSE) {
            $cuerpo = $this->load->view('V_RestaurarC', Array(), true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Reestablecer Contraseña'));
        } else {
            $datos = $this->M_RestaurarClave->getDatosFromUsername($this->input->post('username'));
            $this->EnviaCorreo($datos);
        }
    }

    /**
     * Comprueba si el nombre de un usuario está guardado en la base de datos
     * @param String $username Nombre del usuario
     * @return boolean
     */
    public function ExisteUsuario_check($username) {
        
        if ($this->M_User->getCount_NombreUsuario($username) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Envia un correo para que restablezca la contraseña con los datos especificados
     * @param Array $datos Datos del usuario
     */
    private function EnviaCorreo($datos) {

        $this->email->from('mfmoradaw@gamil.com', 'OlontiaShop');
        $this->email->to($datos['correo']);

        $this->email->subject('Restablece la contraseña en OlontiaShop');

        $mensaje = "Restablece la contraseña accediendo a la siguiente dirección: ";
        $mensaje.= site_url() . "/RestaurarClave/Restablece/" . $datos['id'] . "/" . $this->getTonken($datos['id'], $datos['dni'], $datos['nombre']);
        $this->email->message($mensaje);

        if (!$this->email->send()) {
            $cuerpo = $this->load->view('V_Mailerror', '', true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Mail incorrecto'));
        } else {
            $cuerpo = $this->load->view('V_Mailok', '', true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Mail correcto'));
        }

    }

    /**
     * Devuelve un string encriptado formado por los datos de un usuario
     * @param Int $id ID del usuario
     * @param String $dni DNI del usuario
     * @param String $nombre Nombre del usuario
     * @return String Token generado
     */
    private function getTonken($id, $dni, $nombre) {
        return sha1($id . $dni . $nombre);
    }

    /**
     * Permite a un usuario restablecer su contraseña de usuario con el correo. Se manda una url con el id y un token, si ese id y token son corectos se le permite modificar la contraseña sino no.
     * @param Int $id ID del usuario
     * @param String $token Token generado
     */
    public function Restablece($id, $token) {
        $datos = $this->M_RestaurarClave->getDatosFromId($id);
       
        if (!$datos) {
            $cuerpo = $this->load->view('V_404', Array(), true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
            
            return;
        }
        
        if ($this->getTonken($datos['id'], $datos['dni'], $datos['nombre']) == $token) {
            $this->PideClaveRestablecer($datos['username']);
        } else {
            $cuerpo = $this->load->view('V_404', Array(), true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Error'));
        }
    }

    /**
     * Muestra el formulario para cambiar la contraseña desde el correo
     * @param String $username Nombre del usuario
     */
    public function PideClaveRestablecer($username) {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('ClavesIguales_check', 'Las contraseñas deben ser iguales');
        $this->form_validation->set_rules('clave', 'contraseña', 'required');
        $this->form_validation->set_rules('clave_rep', 'repita contraseña', 'required|callback_ClavesIguales_check');

        if ($this->form_validation->run() == FALSE) {
            $cuerpo = $this->load->view('V_Nuevaclave', Array('username' => $username), true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Restablecer Contraseña'));
        } else {

            $this->M_RestaurarClave->UpdateClave($this->input->post('username'), password_hash($this->input->post('clave'), PASSWORD_DEFAULT));

            $cuerpo = $this->load->view('V_Claveok', Array(), true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'homeactive' => 'active', 'titulo' => 'Restablecer Contraseña'));
        }
    }

    /**
     * Comprueba si dos contraseñas introducidas son correctas
     * @return boolean
     */
    public function ClavesIguales_check() {
        if (claves_check($this->input->post('clave'), $this->input->post('clave_rep')))
            return TRUE;
        else
            return FALSE;
    }

}
