<?php

/**
 * Description of L_Cart
 *
 * @author Manuel Mora
 */
defined('BASEPATH') OR exit('No direct script access allowed');

@session_start();

class L_Cart {
     //Aquí guardamos el contenido del carrito   
    private $carrito = array();

    /**
     * Seteamos el carrito existe o no existe en el constructor
     */
    public function __construct() {

        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = null;
            $this->carrito["precio_total"] = 0;
            $this->carrito["articulos_total"] = 0;
            $this->carrito["precio_iva"] = 0;
        }
        $this->carrito = $_SESSION['carrito'];
    }

    /**
     * Añadimos un producto al carrito
     * @param Array $articulo Datos del producto a añadir en el carrito
     * @throws Exception
     */
    public function add($articulo = array()) {
        
        //primero comprobamos el articulo a añadir, si está vacío o no es un
        //array lanzamos una excepción y cortamos la ejecución
        if (!is_array($articulo) || empty($articulo)) {
            throw new Exception("Error, el articulo no es un array!", 1);
        }
        //nuestro myCarrito necesita siempre un id producto, cantidad y precio articulo
        if (!$articulo["id"] || !$articulo["cantidad"] || !$articulo["precio"]) {
            throw new Exception("Error, el articulo debe tener un id, cantidad y precio!", 1);
        }

        //nuestro myCarrito necesita siempre un id producto, cantidad y precio articulo
        if (!is_numeric($articulo["id"]) || !is_numeric($articulo["cantidad"]) || !is_numeric($articulo["precio"])) {
            throw new Exception("Error, el id, cantidad y precio deben ser números!", 1);
        }

        //debemos crear un identificador único para cada producto
        $unique_id = md5($articulo["id"]);

        //creamos la id única para el producto
        $articulo["unique_id"] = $unique_id;

        //si no está vacío el carrito lo recorremos
        if (!empty($this->carrito)) {
            foreach ($this->carrito as $row) {
                //comprobamos si este producto ya estaba en el
                //carrito para actualizar el producto o insertar
                //un nuevo producto
                if ($row["unique_id"] === $unique_id) {
                    //si ya estaba sumamos la cantidad
                    $articulo["cantidad"] = $row["cantidad"] + $articulo["cantidad"];
                }
            }
        }

        //evitamos que nos pongan números negativos y que sólo sean números para cantidad y precio
        $articulo["cantidad"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["cantidad"]));
        $articulo["precio"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["precio"]));

        //añadimos un elemento total al array carrito para
        //saber el precio total de la suma de este artículo
        $articulo["total"] = $articulo["cantidad"] * $articulo["precio"];

        //primero debemos eliminar el producto si es que estaba en el carrito
        $this->unset_producto($unique_id);

        ///ahora añadimos el producto al carrito
        $_SESSION["carrito"][$unique_id] = $articulo;

        //actualizamos el carrito
        $this->update_carrito();

        //actualizamos el precio total y el número de artículos del carrito
        //una vez hemos añadido el producto
        $this->update_precio_cantidad();
    }

    /**
     * Actualiza el carrito
     * @param Array $articulo Datos del producto a actualizar
     * @throws Exception
     */
    public function actualizar($articulo = array()) {

        //primero comprobamos el articulo a añadir, si está vacío o no es un
        //array lanzamos una excepción y cortamos la ejecución
        if (!is_array($articulo) || empty($articulo)) {
            throw new Exception("Error, el articulo no es un array!", 1);
        }
        //nuestro myCarrito necesita siempre un id producto, cantidad y precio articulo
        if (!$articulo["id"] || !$articulo["cantidad"] || !$articulo["precio"]) {
            throw new Exception("Error, el articulo debe tener un id, cantidad y precio en ACTUALIZAR!", 1);
        }

        //nuestro myCarrito necesita siempre un id producto, cantidad y precio articulo
        if (!is_numeric($articulo["id"]) || !is_numeric($articulo["cantidad"]) || !is_numeric($articulo["precio"])) {
            throw new Exception("Error, el id, cantidad y precio deben ser números!", 1);
        }

        //debemos crear un identificador único para cada producto
        $unique_id = md5($articulo["id"]);

        //creamos la id única para el producto
        $articulo["unique_id"] = $unique_id;

        //si no está vacío el carrito lo recorremos
        if (!empty($this->carrito)) {
            foreach ($this->carrito as $row) {
                //comprobamos si este producto ya estaba en el
                //carrito para actualizar el producto o insertar
                //un nuevo producto
                if ($row["unique_id"] === $unique_id) {
                    //si ya estaba sumamos la cantidad
                    $articulo["cantidad"] = /* $row["cantidad"] */ + $articulo["cantidad"];
                }
            }
        }

        //evitamos que nos pongan números negativos y que sólo sean números para cantidad y precio
        $articulo["cantidad"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["cantidad"]));
        $articulo["precio"] = trim(preg_replace('/([^0-9\.])/i', '', $articulo["precio"]));

        //añadimos un elemento total al array carrito para
        //saber el precio total de la suma de este artículo
        $articulo["total"] = $articulo["cantidad"] * $articulo["precio"];

        //primero debemos eliminar el producto si es que estaba en el carrito
        $this->unset_producto($unique_id);

        ///ahora añadimos el producto al carrito
        $_SESSION["carrito"][$unique_id] = $articulo;

        //actualizamos el carrito
        $this->update_carrito();

        //actualizamos el precio total y el número de artículos del carrito
        //una vez hemos añadido el producto
        $this->update_precio_cantidad();
    }

    /**
     * Actualiza el precio total y la cantidad de productos total del carrito
     */
    private function update_precio_cantidad() {
        //Reseteamos las variables precio y artículos a 0
        $precio = 0;
        $articulos = 0;

        //recorrecmos el contenido del carrito para actualizar
        //el precio total y el número de artículos
        foreach ($this->carrito as $row) {
            $precio += ($row['precio'] * $row['cantidad']);
            $articulos += $row['cantidad'];
        }
        $iva= $this->PrecioIVA($precio);
        //asignamos a articulos_total el número de artículos actual
        //y al precio el precio actual
        $_SESSION['carrito']["articulos_total"] = $articulos;
        $_SESSION['carrito']["precio_total"] = $precio;
        $_SESSION['carrito']["precio_iva"] = $iva; 
      

        //refrescamos él contenido del carrito para que quedé actualizado
        $this->update_carrito();
    }
    /**
      @desc calcular el precio con iva para el precio pasado
      @return float precio con iva
     */
    public function PrecioIVA($precio, $iva = 21) {
        $precioIva = ($precio * $iva / 100);

        $precioNormalizado = floatval(sprintf("%.2f", $precioIva));

        return $precio + $precioNormalizado;
    }
        /**
     * Devuelve el precio total del carrito
     * @return Float precio
     * @throws Exception
     */
    public function precio_total() {

        //si no está definido el elemento precio_total o no existe el carrito
        //el precio total será 0
        if (!isset($this->carrito["precio_total"]) || $this->carrito === null) {
            return 0;
        }
        //si no es númerico lanzamos una excepción porque no es correcto
        if (!is_numeric($this->carrito["precio_total"])) {
            throw new Exception("El precio total del carrito debe ser un número", 1);
        }
        //en otro caso devolvemos el precio total del carrito
        return $this->carrito["precio_total"] ? $this->carrito["precio_total"] : 0;
    }

    /**
     * Devuelve el precio total del carrito
     * @return Float precio
     * @throws Exception
     */
    public function precio_iva() {
       
        //si no está definido el elemento precio_total o no existe el carrito
        //el precio total será 0
        if (!isset($this->carrito["precio_iva"]) || $this->carrito === null) {
            return 0;
        }
        //si no es númerico lanzamos una excepción porque no es correcto
        if (!is_numeric($this->carrito["precio_iva"])) {
            throw new Exception("El precio con iva del carrito debe ser un número", 1);
        }
        //en otro caso devolvemos el precio total del carrito
        return $this->carrito["precio_iva"] ? $this->carrito["precio_iva"] : 0;
    }

    /**
     * Devuelve el número de artículos del carrito
     * @return int Cantidad artículos
     * @throws Exception
     */
    public function articulos_total() {
        
        //si no está definido el elemento articulos_total o no existe el carrito
        //el número de artículos será de 0
        if (!isset($this->carrito["articulos_total"]) || $this->carrito === null) {
            return 0;
        }
        //si no es númerico lanzamos una excepción porque no es correcto
        if (!is_numeric($this->carrito["articulos_total"])) {
            throw new Exception("El número de artículos del carrito debe ser un número", 1);
        }
        //en otro caso devolvemos el número de artículos del carrito

        return $this->carrito["articulos_total"] ? $this->carrito["articulos_total"] : 0;
    }

    /**
     * Devuelve el contenido del carrito
     * @return type
     */
    public function get_content() {
        //asignamos el carrito a una variable
        $carrito = $this->carrito;
        //debemos eliminar del carrito el número de artículos
        //y el precio total para poder mostrar bien los artículos
        //ya que estos datos los devuelven los métodos
        //articulos_total y precio_total
        unset($carrito["articulos_total"]);
        unset($carrito["precio_total"]);
        unset($carrito["precio_iva"]);
        return $carrito == null ? array(): $carrito;
    }

    /**
     * Método que llamamos al insertar un nuevo producto al carrito para eliminarlo si existía, así podemos insertarlo de nuevo pero actualizado
     * @param Int $unique_id Clave única del producto
     */
    private function unset_producto($unique_id) {
        unset($_SESSION["carrito"][$unique_id]);
    }

    /**
     * Elimina un producto pero le debemos pasar la clave única que contiene cada uno de ellos
     * @param Int $unique_id Clave única del producto
     * @return boolean
     * @throws Exception
     */
    public function remove_producto($unique_id) {
        //si no existe el carrito
        if ($this->carrito === null) {
            throw new Exception("El carrito no existe!", 1);
        }

        //si no existe la id única del producto en el carrito
        if (!isset($this->carrito[$unique_id])) {
            throw new Exception("La unique_id $unique_id no existe!", 1);
        }

        //en otro caso, eliminamos el producto, actualizamos el carrito y
        //el precio y cantidad totales del carrito
        unset($_SESSION["carrito"][$unique_id]);
        $this->update_carrito();
        $this->update_precio_cantidad();
        return true;
    }

    /**
     * Eliminamos el contenido del carrito por completo
     * @return boolean
     */
    public function destroy() {
        unset($_SESSION["carrito"]);
        $this->carrito = null;
        return true;
    }

    /**
     * Actualizamos el contenido del carrito
     */
    public function update_carrito() {
        self::__construct();
    }

}
