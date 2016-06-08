<?php
/**
 * CONTROLADOR en el que se inicia y se cierra sesión en la aplicación.
 *
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
   
    public function __construct() {
        parent::__construct();
        $this->load->library('L_Cart', 0, 'myCart');
        $this->load->model('M_User');
    }

    /**
     * Muestra la vista del login y comprueba que los datos sean correctos
     */
    public function index() {
        if (SesionIniciadaCheck()) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }

        if ($this->input->post('entrar')) {//Botón entrar pulsado
        
            if ($this->M_User->getCount_NombreUsuario($this->input->post('username')) > 0) {//Existe Usuario
                if (password_verify($this->input->post('clave'), $this->M_User->getClave($this->input->post('username')))) {
                    //la clave es correcta
                    $this->Login($this->input->post('username'));
                } else {
                    $this->MuestraErrorEnVista();
                }
            } else {
                $this->MuestraErrorEnVista();
            }
        } else {
            $cuerpo=$this->load->view('V_Login',Array(),TRUE ); //Generamos la vista
            $this->load->view('V_Plantilla', Array('titulo' => 'Login', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
        }
    }

    /**
     * Inicia sesión en la aplicación
     * @param String $username Nombre del usuario
     */
    public function Login($username) {
        
        if ($username) {
            $datos = array(
                'username' => $username,
                'userid' => $this->M_User->getId($username),
                'logged_in' => TRUE
            );

            $this->session->set_userdata($datos);
        }
        redirect('', 'location', 301);
    }

    /**
     * Cierra la sesión iniciada
     */
    public function Logout() {

        if (SesionIniciadaCheck()) {//Sólo puede cerrar sesión si está iniciada, por si entra por url
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('userid');
            $this->session->unset_userdata('logged_in');

//            $this->myCarrito->destroy(); //Borramos también su carrito
            redirect('', 'location', 301);
        } else {
            $cuerpo = $this->load->view('V_404', '', true); //Generamos la vista
            $this->load->view('V_Plantilla', Array('titulo' => 'Error 404', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
        }
    }

    /**
     * Muestra un error si se ha introducido algún dato incorrecto
     */
    public function MuestraErrorEnVista() {
        $error = "<div class='alert alert-danger'><b>¡Error!</b> Usuario o contraseña incorrectos</div>";
        $cuerpo = $this->load->view('V_Login', array('error' => $error), true); //Generamos la vista
        $this->load->view('V_Plantilla', Array('titulo' => 'Login', 'cuerpo' => $cuerpo, 'homeactive' => 'active'));
    }

}
