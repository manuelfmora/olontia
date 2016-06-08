<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of login
 *
 * @author Manuel Mora
 */
class User_insert extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();        
        $this->load->helper ('Formulario');
        $this->load->model('M_Provincias');
        $this->load->model('M_User');    
        $this->load->library('form_validation');
//        $this->load->library('Carro', 0, 'myCarrito');
    
    }

    /**
     * Muestra el formulario de registro
     */
    public function index() {
//        $provincias = $this->M_provincias->getProvincias();
//        $select = CreaSelect($provincias, 'cod_provincia');
//                $config = $this->getConfigPag();        

//        $cuerpo = $this->load->view('View_registro', array('select' => $select), true);
//        $cuerpo=  $this->load->view('View_registro', array('select' => $select), true);
  

        $this->load->view('V_Userinsert_', Array(),true);
//        $this->load->view('V_Plantilla', Array(
//            'modal'=>$modal,
//                                              ));
    }

    /**
     * Comprueba que los datos introducidos en el formulario sean correctos
     */
    public function Usuario() {
        $provincias = $this->Mdl_provincias->getProvincias();
        $select = CreaSelect($provincias, 'cod_provincia');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><b>¡Error! </b>', '</div>');

        //Establecemos los mensajes de errores
        $this->setMensajesErrores();
        
        //Establecemos reglas de validación para el formulario
        $this->setReglasValidacion();

        if ($this->form_validation->run() == FALSE || !claves_check($this->input->post('clave'), $this->input->post('rep_clave'))) {//Validación de datos incorrecta
            $errorclave = '';

            if (!claves_check($this->input->post('clave'), $this->input->post('rep_clave'))) {//Si las claves no son iguales, se muestra error
                $errorclave = '<div class="alert alert-danger"><b>¡Error! </b> Las contraseñas no son iguales</div>';
            }
            
            $cuerpo = $this->load->view('View_registro', array('select' => $select, 'errorclave' => $errorclave), true);
            $this->load->view('View_plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Registro de Usuario',
                'homeactive' => 'active'));
        } else {//Validación de datos correcta
            
            //Crea el array de los datos a insertar en la tabla usuario
            foreach ($this->input->post() as $key => $value) {
                if($key == 'clave')
                {
                    $data[$key] = password_hash($value, PASSWORD_DEFAULT);
                }
                else if ($key != 'rep_clave' && $key != 'GuardarUsuario')
                    $data[$key] = $value;
                
            }
            
            $this->Mdl_usuarios->addUsuario($data);//Inserta en la tabla usuario
            
            redirect('Login/Login/'.$data['nombre_usu'], 'location', 301);
        }
    }

    /**
     * Comprueba si un DNI es correcto
     * @param String $dni DNI a comprobar
     * @return boolean
     */
    function dni_check($dni) {

        $numerosDNI = substr($dni, 0, 8);
        $letraDNI = substr($dni, 8, 1);
        $letraDNI = strtoupper($letraDNI);

        if (is_numeric($numerosDNI) && ($letraDNI == dni_LetraNIF($dni))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Comprueba si un nombre de usuario está ya usado
     * @param String $nombre_usu Nombre del usuario a comprobar
     * @return boolean
     */
    function nombreUsuRepetido_check($nombre_usu) {

        $countNomUsuario = $this->Mdl_usuarios->getCount_NombreUsuario($nombre_usu);

        if ($countNomUsuario == 0) {//No existen nombres guardados
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Establece los mensajes de error que se mostrarán si no se valida correctamente el formulario
     */
    function setMensajesErrores(){
        $this->form_validation->set_message('required', 'El campo %s está vacío');
        $this->form_validation->set_message('valid_email', 'Formato de correo electrónico incorrecto');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número de 5 dígitos');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('integer', 'El campo %s debe ser númerico');
        $this->form_validation->set_message('dni_check', 'Formato de DNI incorrecto');
        $this->form_validation->set_message('nombreUsuRepetido_check', 'El nombre de usuario ya existe');
    }
   
    /**
     * Establece las reglas que deben seguir cada campo del formulario
     */
    function setReglasValidacion(){
        $this->form_validation->set_rules('nombre_usu', 'nombre de usuario', 'required|callback_nombreUsuRepetido_check');
        $this->form_validation->set_rules('clave', 'contraseña', 'required');
        $this->form_validation->set_rules('rep_clave', 'repita contraseña', 'required');
        $this->form_validation->set_rules('correo', 'correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('nombre_persona', 'nombre', 'required');
        $this->form_validation->set_rules('apellidos_persona', 'apellidos', 'required');
        $this->form_validation->set_rules('dni', 'DNI', 'required|exact_length[9]|callback_dni_check');
        $this->form_validation->set_rules('direccion', 'dirección', 'required');
        $this->form_validation->set_rules('cp', 'CP', 'required|integer|exact_length[5]');
        $this->form_validation->set_rules('cod_provincia', 'provincia', 'required');
    }
//      public function getConfigPag(){
//        //Configuración de Paginación
//        $config['base_url'] = site_url('/Main/index');
//        $config['total_rows'] = $this->M_Cd->getNumTotalProductosSeleccionados();       
//        $config['per_page'] = $this->config->item('per_page_seleccionadas');
//        $config['uri_segment'] = 3;
//        $config['full_tag_open'] = '<ul class="pagination">';
//        $config['full_tag_close'] = '</ul>';
//        $config['num_tag_open'] = '<li>';
//        $config['num_tag_close'] = '</li>';
//        $config['cur_tag_open'] = '<li class="pag_activa"><span>';
//        $config['cur_tag_close'] = '</span></li>';
//        $config['prev_tag_open'] = '<li title="Anterior">';
//        $config['prev_tag_close'] = '</li>';
//        $config['next_tag_open'] = '<li title="Siguiente">';
//        $config['next_tag_close'] = '</li>';
//        $config['first_link'] = '«';
//        $config['prev_link'] = '‹';
//        $config['last_link'] = '»';
//        $config['next_link'] = '›';
//        $config['first_tag_open'] = '<li title="Inicio">';
//        $config['first_tag_close'] = '</li>';
//        $config['last_tag_open'] = '<li title="Final">';
//        $config['last_tag_close'] = '</li>';
//
//    
//        return $config;
//    }
}
