<?php
/**
 * CONTROLADOR en que cada usuario puede modificar su cuenta en la aplicación.
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModify extends CI_Controller {

    public function __construct() {
        parent::__construct();  
        
        $this->load->helper('Formulario');
        $this->load->model('M_Provincias');
        $this->load->model('M_User');    
        $this->load->library('form_validation');
        $this->load->library('L_Cart', 0, 'myCart');
    }

    /**
     * Muestra el formulario para modificar un usuario
     */
    public function index() {

        if (!SesionIniciadaCheck()) {
            redirect("404", 'Location', 301);
            return; //Sale de la función
        }

        $provincias = $this->M_Provincias->getProvincias();
        $datos = $this->M_User->getDatosModificar($this->session->userdata('username'));

        $select = CreaSelectMod($provincias, 'cod_provincia', $datos['cod_provincia']);

        $cuerpo = $this->load->view('V_UserModify', array(
                                                            'select' => $select, 
                                                            'datos' => $datos), true);

        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario', 'homeactive' => 'active'));
    }

    /**
     * Modifica un usuario si se han introducido correctamente los datos
     */
    public function Modificar() {

        if (SesionIniciadaCheck()) {
            $todocorrecto = TRUE;
            $cambiarclave = FALSE;

            $provincias = $this->M_Provincias->getProvincias();
            $select = CreaSelect($provincias, 'cod_provincia');

            $datos = $this->M_User->getDatosModificar($this->session->userdata('username'));

            //Establecemos los mensajes de errores
            $this->setMensajesErrores();
            //Establecemos reglas de validación para el formulario
            $this->setReglasValidacion();

            if ($this->form_validation->run() == FALSE) {//Validación de datos incorrecta
                $cuerpo = $this->load->view('V_UserModify', array(
                    'select' => $select,
                    'datos' => $datos), true);

                $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo,
                    'titulo' => 'Modificar Usuario',
                    'homeactive' => 'active'));



                $todocorrecto = FALSE;
            } else {

                if ($this->setRVcalven() == FALSE) {

                    $errorclavenuevo = '<div class="alert alert-danger"><b>¡Error! </b> Las contraseñas no pueden estar vacias1</div>';
                    $cuerpo = $this->load->view('V_UserModify', array(
                        'select' => $select,
                        'errorclavenuevo' => $errorclavenuevo,
                        'datos' => $datos), true);
                    $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
                        'homeactive' => 'active'));

                    $todocorrecto = FALSE;
                }
                if ($this->setRVcalverep() == FALSE) {

                    $errorclaverep = '<div class="alert alert-danger"><b>¡Error! </b> Las contraseñas no pueden estar vacias2</div>';
                    $cuerpo = $this->load->view('V_UserModify', array(
                        'select' => $select,
                        'errorclaverep' => $errorclaverep,
                        'datos' => $datos), true);
                    $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
                        'homeactive' => 'active'));

                    $todocorrecto = FALSE;
                }
                
                $cambiarclave = TRUE;
                if (!claves_check($this->input->post('clave_nueva'), $this->input->post('rep_clave_nueva'))) {

                    $errorclave = '<div class="alert alert-danger"><b>¡Error! </b> Las contraseñas no son iguales</div>';
                    $cuerpo = $this->load->view('V_UserModify', array(
                        'select' => $select,
                        'errorclave' => $errorclave,
                        'datos' => $datos), true);
                    $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
                        'homeactive' => 'active'));

                    $todocorrecto = FALSE;
                }

                if ($todocorrecto) {


                    //Crea el array de los datos a insertar en la tabla usuario
                    foreach ($this->input->post() as $key => $value) {
                        if ($key == 'clave_nueva' && $cambiarclave) {
                            $data['clave'] = password_hash($value, PASSWORD_DEFAULT);
                        } else if ($key == 'clave' && !$cambiarclave) {
                            $data['clave'] = password_hash($value, PASSWORD_DEFAULT);
                        }

                        if ($key != 'rep_clave_nueva' && $key != 'GuardarUsuario' && $key != 'clave_nueva' && $key != 'clave') {
                            $data[$key] = $value;
                        }
                    }
                  

                    $datos = array('username'=>$this->input->post('nombre_usu'));
                   
                    $this->session->set_userdata($datos);
                    $this->M_User->updateUsuario($this->session->userdata('userid'),$data); //Inserta en la tabla usuario
                    $cuerpo = $this->load->view('V_UserModifyok', array(), true);
                    $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Modificar Usuario',
                        'homeactive' => 'active'));
                }
            }
        }
    }

    /**
     * Devuelve si un nombre de usuario ya está guardado en la base de datos
     * @param String $nombre_usu Nombre del usuario
     * @return boolean
     */
    function nombreUsuRepetido_check($nombre_usu) {

        $countNomUsuario = $this->M_User->getCount_NombreUsuarioModificar($nombre_usu, $this->session->userdata('userid'));

        if ($countNomUsuario == 0) {//No existen nombres guardados
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Devuelve si la clave introducida corresponde con la guardada en la base de datos
     * @return boolean
     */
    function clavecorrecta_check() {

        if (password_verify($this->input->post('clave'), $this->M_User->getClave($this->session->userdata('username'))))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario
     */
    function setMensajesErrores() {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><b>¡Error! </b>', '</div>');
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número de 5 dígitos');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('nombreUsuRepetido_check', 'El nombre de usuario ya existe');
        $this->form_validation->set_message('clavecorrecta_check', 'La contraseña es incorrecta');
    }

    /**
     * Establece las reglas que deben seguir cada campo del formulario
     */
    function setReglasValidacion() {
        $this->form_validation->set_rules('nombre_usu', 'nombre de usuario', 'required|callback_nombreUsuRepetido_check');
        $this->form_validation->set_rules('clave', 'contraseña', 'required|callback_clavecorrecta_check');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('cp', 'CP', 'required|integer|exact_length[5]');
        $this->form_validation->set_rules('cod_provincia', 'provincia', 'required');
    }
    
    public function setRVcalven(){


       $this->form_validation->set_rules('clave_nueva', 'Contraseña Nueva', 'required');
       if($this->form_validation->run() == FALSE){
           return FALSE;
       }else{
           return TRUE;
       }
    }
    public function setRVcalverep(){

      $this->form_validation->set_rules('rep_clave_nueva', 'Repita Contraseña Nueva', 'required');
       if($this->form_validation->run() == FALSE){
           return FALSE;
       }else{
           return TRUE;
       }
    }

}
