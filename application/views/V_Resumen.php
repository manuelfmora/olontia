<?php
/*
 * VISTA que muestra el resumen del carrito.
 * Si el carrito está vacío muestra un error.
 */
?>



  <section id="aa-catg-head-banner">
      <img src="<?= base_url() . 'assets/img/imgAPP/header/platos.jpg' ?>" alt="Registrarse img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Resumen del pedido</h2>
        <ol class="breadcrumb">
            <li><a href=<?=  base_url().'index.php'?>>Home</a></li>                   
          <li class="active">Resumen del pedido</li>
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
                    
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Iva</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>  <!--Creación tabla de productos-->
               
                        <?php foreach ($lineaspedidos as $linea): ?>
                      <tr>
                        <!--Imagen-->
                        <td><img width="145" height="145" class="shop_thumbnail" src="<?= base_url() . 'assets/img/imgAPP/' . $linea['imagen'] ?>"></td>
                       <!--Producto-->
                        <td><?= $linea['nombre_pro'] ?>  </td>
                        <!--Precio-->
                        <td><?= round($linea['precio']*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></td>
                         <!--IVA-->
                         <td><?= $linea['iva'] ?>&nbsp;%</td>
                        <!--Cantidad-->
                        <td class="aa-cart-quantity"><?= $linea['cantidad'] ?> </td>
                        <!--Total-->
                        <td><span class="amount"><?= round($linea['importe']*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></span></td>
                      </tr>
                       <?php endforeach; ?>
                        <!--/Creación tabla de productos-->
                
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div style="position: relative;"class="cart-view-total">
               <h4>Importe</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td><?= round($pedido['importe']*$this->session->userdata('rate'), 2) ?>&nbsp;<?=$this->session->userdata('currency')?></td>
                   </tr>
                   <tr>
                       <th>Total<br><h6>Impuestos incluidos</h6></th>                    
                       <td><?=$pedido['importeiva']?></td>
                   </tr>
                   <tr>
                       <th>Estado</th>                    
                       <td><?= $pedido['estado'] ?></td>
                   </tr>
                    <tr>
                       <th>Fecha Pedido</th>                    
                       <td><?= cambiaFormatoFecha($pedido['fecha_pedido']) ?></td>
                   </tr>
                 </tbody>
               </table>
              
             </div>
             <br>
             <!--------Datos de envío-------------->
               <div class="cart-view-total">
               <h4>Datos de envío</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Dirección</th>
                     <td><?= $datosenvio['direccion'] ?></td>
                   </tr>
                   <tr>
                       <th>Código Postal<br></th>                    
                       <td><?= $datosenvio['cp'] ?></td>
                   </tr>
                   <tr>
                       <th>Provincia</th>                    
                       <td><?= $datosenvio['provincia'] ?></td>
                   </tr>                  
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
