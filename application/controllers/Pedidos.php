<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CONTROLADOR que realiza un pedido
 */
class Pedidos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Pedidos');
        $this->load->model('M_Provincias');
        $this->load->library('L_Cart', 0, 'myCart');
        $this->load->library('email');
        $this->load->helper('Formulario');
    }

    /**
     * Guarda el pedido en la base de datos con los productos que se han comprado a tráves del carrito
     */
    public function RealizaPedido() {
        
        if (SesionIniciadaCheck()) {
            $pedido = Array();

            $datos = $this->M_Pedidos->getDatosParaPedido($this->session->userdata('userid'));

            $pedido['idUsuario'] = $this->session->userdata('userid');
            $pedido['importe'] = $this->myCart->precio_total();  
            $pedido['cantidad_total'] = $this->myCart->articulos_total();
            $pedido['fecha_pedido'] = date("Y-m-j");
            $pedido['direccion'] = $datos['direccion'];
            $pedido['cp'] = $datos['cp'];
            $pedido['cod_provincia'] = $datos['cod_provincia'];
            $pedido['correo'] = $datos['correo'];
            $pedido['importeiva'] = $this->myCart->precio_iva();

            $idPedido = $this->M_Pedidos->insertPedido($pedido);

            $lineas_pedidos = Array();
            
            foreach ($this->myCart->get_content() as $items) {
                $linea_pedido = Array();
                $linea_pedido['idProducto'] = $items['id'];
                $linea_pedido['idPedido'] = $idPedido;
                $linea_pedido['iva'] = $this->M_Pedidos->getIva($items['id'])['iva'];
                $linea_pedido['precio'] = $items['precio'];
                $linea_pedido['cantidad'] = $items['cantidad'];
                $linea_pedido['importe'] = $items['precio'] * $items['cantidad'];

                $this->M_Pedidos->insertLineaPedido($linea_pedido);
                $lineas_pedidos[] = $linea_pedido;
                
                $this->M_Pedidos->CambiaStock($items['id'], $items['cantidad']);
            }

            $datos = $this->M_Pedidos->getDatosFromUsername($this->session->userdata('username'));

            $this->EnviaCorreo($datos['correo'], $idPedido);
             
            

            $this->myCart->destroy(); //Vacíamos carrito
            redirect('Pedidos/MuestraResumen/' . $idPedido,'Location', 301);

        } else {
            redirect('Sessionnull', 'Location', 301);
        }
    }

    /**
     * Muestra un resumen de un pedido determinado
     * @param Int $idPedido ID del pedido
     */
    public function MuestraResumen($idPedido) {

        $pedido = $this->M_Pedidos->getPedido($idPedido, $this->session->userdata('userid'));

        if (!$pedido) {
            redirect("Error404", 'Location', 301);
            return; //Sale de la función
        }

        $datosenvio = $this->M_Pedidos->getDatosEnvio($idPedido);
        $datosenvio['provincia'] = $this->M_Provincias->getNombreProvincia($datosenvio['cod_provincia']);

        $lineaspedidos = $this->M_Pedidos->getLineasPedidos($idPedido);
        
        $cuerpo = $this->load->view('V_Resumen', Array(
                                                         'pedido' => $pedido,                                                          
                                                          'datosenvio' => $datosenvio,
                                                          'lineaspedidos' => $lineaspedidos), true);
        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 'titulo' => 'Resumen del pedido', 'homeactive' => 'active'));
    }

    /**
     * Crea un PDF de un pedido determinado con todos los datos del pedido y los productos comprados
     * @param Int $idPedido ID del pedido
     * @param Char $metodo I --> envía el fichero al navegador / D --> Fuerza la descarga
     */
    private function CreaPDF_Pedido($idPedido, $metodo = 'F') {
        $this->load->library('Pdf', 0, 'myPDF');

        $this->myPDF->AddPage();
        $this->myPDF->AliasNbPages(); //nº de páginas
        $this->myPDF->SetFont('Arial', '', 10);

        //DATOS que ponemos al principio de la factura
        $datos = $this->M_Pedidos->getDatosParaPDF($this->session->userdata('userid'));

        $this->myPDF->Cell(0, 7, utf8_decode($datos['nombre_persona'] . ' ' . $datos['apellidos_persona']), 0, 1);
        $this->myPDF->Cell(0, 7, utf8_decode("DNI: " . $datos['dni']), 0, 1);
        $this->myPDF->Cell(0, 7, utf8_decode($datos['direccion'] . ', ' . $datos['cp'] . ' (' . $datos['provincia'] . ')'), 0, 1);

        //TABLA LÍNEA DE PEDIDOS
        $lineas_pedidos = $this->M_Pedidos->getLineasPedidos($idPedido);
        foreach ($lineas_pedidos as $linea) {
            $data[] = $linea;
        }

        $this->myPDF->CreaTablaLineaPedidos($data);

        //TABLA PEDIDO
        $pedido = $this->M_Pedidos->getPedido($idPedido, $this->session->userdata('userid'));
        $this->myPDF->CreaTablaPedido($pedido);

        $this->myPDF->Output($metodo, 'assets/pdf/pedido.pdf', true);
    }

    /**
     * Envia un correo con el PDF del pedido
     * @param String $correo Dirección de mail donde se tiene que mandar el correo
     * @param Int $idPedido ID del pedido
     */
    public function EnviaCorreo($correo, $idPedido) {

        $this->CreaPDF_Pedido($idPedido);
        
        $this->email->from('aula4@iessansebastian.com', 'OlontiaShop');
        
        $this->email->to($correo);

        $this->email->subject('Le enviamos el albarán de su pedido con fecha '.date("j-m-Y"));

        $mensaje = "Aquí puede ver el albarán de su pedido para su conformidad.<br><br> Un saludo OlontiaShop";

        $this->email->message($mensaje);

        $this->email->attach('assets/pdf/pedido.pdf');

        if (!$this->email->send())
            echo "<pre>\n\nError ennviado mail\n</pre>";
    }

    /**
     * Muestra un pedido en el navegador
     * @param Int $idPedido ID del pedido
     */
    public function VerPDFPedido($idPedido) {
        $this->CreaPDF_Pedido($idPedido, 'I');
    }

    /**
     * Descarga un pedido en la carpeta 'Descargas'
     * @param Int $idPedido ID del pedido
     */
    public function DescargarPDFPedido($idPedido) {
        $this->CreaPDF_Pedido($idPedido, 'D');
    }
}
