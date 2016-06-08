<?php
/*
 * VISTA que muestra información sobre los productos comprados.
 * Si el carrito está vacío muestra un error.
 */
?>

<?php if ($this->myCart->articulos_total() > 0):?>
<!-- catg header banner section -->

  <section id="aa-catg-head-banner">
      <img src="<?= base_url() . 'assets/img/imgAPP/header/banneru2.jpg' ?>" alt="Registrarse img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Carrito</h2>
        <ol class="breadcrumb">
            <li><a href=<?=  base_url().'index.php'?>>Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
               <form action="" method="post">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Eliminar</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>  <!--Creación tabla de productos-->
                    <div><span> <?php
                                    if (isset($error))
                                        echo $error;
                                    ?></span></div>
                        <?php foreach ($this->myCart->get_content() as $items): ?>
                    
                      <tr>
                          <!--Eliminar-->
                        <td><a class="remove" href="<?= base_url().'index.php/Cart/eliminar/'. $items['id']?>"><fa class="fa fa-close"></fa></a></td>
                        <!--Imagen-->
                        <td><a href=" <?= base_url() . 'index.php/VerCd/ver/' . $items['id'] ?>"><img width="145" height="145" class="shop_thumbnail" src="<?= base_url() . 'assets/img/imgAPP/' . $items['opciones']['imagen'] ?>"></a></td>
                       <!--Producto-->
                        <td><a class="aa-cart-title" href="<?= base_url() . 'index.php/VerCd/ver/' . $items['id'] ?>"><?= $items['nombre'] ?></a></td>
                        <!--Precio-->
                        <td><?= round($items['precio']*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></td>
                        <!--Cantidad-->
                        <!--------------------------------------------------------------------------------------->
                        <td><input class="aa-cart-quantity" id="cantidad[<?= $items['id'] ?>]" name="cantidad[<?= $items['id'] ?>]" type="number" value="<?= $items['cantidad'] ?>" min="1" max="<?= $this->M_Cart->getStock($items['id']); ?>" step="1"></td>
                        <!--Total-->
                        <td><span class="amount"><?= round($items['total']*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></span></td>
                      </tr>
                       <?php endforeach; ?>
                        <!--/Creación tabla de productos-->
                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                           <div class="aa-cart-coupon">                              
                               <a href="<?= base_url() . 'index.php/Cart/eliminarcompra' ?>">
                                   <input class="aa-cart-view-btn" type="button" value="Eliminar Pedido"></a>
                          </div>
                          <div class="aa-cart-coupon">                              
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?= base_url() ?>">
                                   <input class="aa-cart-view-btn" type="button" value="Seguir comprando"></a>
                          </div>
                          <input class="aa-cart-view-btn" type="submit"  name="guardar" value="Actualizar Carrito">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Importe</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td><?= round($this->myCart->precio_total()*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></td>
                   </tr>
                   <tr>
                       <th>Total<br><h6>Impuestos incluidos</h6></th>                    
                     <td><?=round($this->myCart->precio_iva(),2)?></td>
                   </tr>
                 </tbody>
               </table>
               <a href="<?= base_url() . 'index.php/Pedidos/RealizaPedido' ?>" class="aa-cart-view-btn">Realizar pedido</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
<?php endif;?>
 
<?php if ($this->myCart->articulos_total() <= 0):
    $this->load->view('V_Cartvacio');
?>
<?php endif; ?>
