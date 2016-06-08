<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Xml extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('L_Cart', 0, 'myCart');
        $this->load->model('M_Xml');
    }

    /**
     * Crea y descarga un fichero XML con las categorías y los productos guardadas en la Base de Datos 
     */
    public function exportar() {

        $categorias = $this->M_Xml->getCategorias();
       
        $xml = new SimpleXMLElement('<categorias/>'); //Crea el nodo principal <categorias>

        foreach ($categorias as $categoria) {
            $xml_cat = $xml->addChild('categoria'); //Crea etiqueta <categoria> dentro de <categorias>
            foreach ($categoria as $key => $value) {

                if ($key != 'idCategoria') {
                    $xml_cat->addChild($key, utf8_encode($value)); //Añade los datos de la categoria a <categoria>
                }
            }
            $this->XMLAddProductos($xml_cat, $categoria['idCategoria']); //Añade a <categoria> sus <productos>
        }
        
        header('Content-Description: File Transfer');
        Header('Content-type: text/xml; charset=utf-8');
        Header('Content-type: octec/stream');
        Header('Content-disposition: filename="productosycategorias.xml"');
        print($xml->asXML());
    }

    /**
     * Crea la parte de los productos en XML
     * @param XML $xml_cat XML de la categoría correspondiente
     * @param Int $idCat ID de la categoría correspondiente
     */
    protected function XMLAddProductos($xml_cat, $idCat) {
        $lista_productos = $this->M_Xml->getProductos($idCat);

        $xml_productos = $xml_cat->addChild('productos'); //Crea etiqueta <Productos> dentro de <categoria>

        foreach ($lista_productos as $producto) {
            $xml_producto = $xml_productos->addChild('producto'); //Crea etiqueta <producto> dentro de <producto>

            foreach ($producto as $idx => $valor) {
                $xml_producto->addChild($idx, utf8_encode($valor)); //Añade a la etiqueta <producto>
            }
        }
    }

    /**
     * Muestra el formulario donde tenemos que seleccionar el archivo XML para importar. 
     */
    public function importar() {
        $cuerpo = $this->load->view('V_XmlImport', Array(), true);
        $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 
                                                    'homeactive' => 'active', 
                                                    'titulo' => 'Importación en XML'));
    }

    /**
     * Importa los datos del archivo XML seleccionado. Este archivo debe tener el formato válido para importarlo
     */
    public function ProcesaArchivo() {

        $archivo = $_FILES['archivo'];

        if (file_exists($archivo['tmp_name'])) {
            $contentXML = utf8_encode(file_get_contents($archivo['tmp_name']));
            $xml = simplexml_load_string($contentXML);

            $this->InsertFromXML($xml);

            $cuerpo = $this->load->view('V_Importok', '', true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo, 
                                                    'titulo' => 'Importación en XML', 
                                                    'homeactive' => 'active'));
        } else {
            $cuerpo = $this->load->view('V_Eimport', '', true);
            $this->load->view('V_Plantilla', Array('cuerpo' => $cuerpo,
                                                    'titulo' => 'Importación en XML',
                                                    'homeactive' => 'active'));
        }
    }
   
    /**
     * Crea un array con los datos que lee desde el XML para insertarlos en la Base de datos
     * @param XML $xml XML que estamos leyendo
     */
    function InsertFromXML($xml) {

        foreach ($xml as $categoria) {

            $cat['cod_categoria'] = (string) $categoria->cod_categoria;
            $cat['nombre_cat'] = (string) $categoria->nombre_cat;
            $cat['descripcion'] = (string) $categoria->descripcion;
            $cat['mostrar'] = (string) $categoria->mostrar;

            // Inserta categoria
            $categoria_id = $this->M_Xml->addCategoria($cat);//Guardamos su id para poder insertar los productos en esa categoría

            foreach ($categoria->productos->producto as $producto) {

                $pro['cod_producto'] = (string) $producto->cod_producto;
                $pro['nombre_pro'] = (string) $producto->nombre_pro;
                $pro['precio'] = (string) $producto->precio;
                $pro['imagen'] = (string) $producto->imagen;
                $pro['iva'] = (string) $producto->iva;
                $pro['descuento'] = (string) $producto->descuento;
                $pro['descripcion'] = (string) $producto->descripcion;
                $pro['seleccionada'] = (string) $producto->seleccionada;
                $pro['mostrar'] = (string) $producto->mostrar;
                $pro['fecha_inicio'] = (string) $producto->fecha_inicio;
                $pro['fecha_fin'] = (string) $producto->fecha_fin;
                $pro['stock'] = (string) $producto->stock;

                $pro['idCategoria'] = $categoria_id;
                // Inserta producto
                $this->M_Xml->AddProducto($pro);
            }
        }
    }

}
