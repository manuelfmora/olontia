<?php
/*
 * VISTA que muestra la lista de pedidos.
 * Si la lista de pedidos está vacía muestra un error.
 */
?>



  <section id="aa-catg-head-banner">
      <img src="<?= base_url() . 'assets/img/imgAPP/header/platos.jpg' ?>" alt="Registrarse img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Lista de pedidos.</h2>
        <ol class="breadcrumb">
            <li><a href=<?=  base_url().'index.php'?>>Home</a></li>                   
          <li class="active">Lista de pedidos</li>
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
             
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>                    
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Importe</th>
                        <th>Dirección</th>
                        <th>C.P.</th>
                        <th>Provincia</th>
                        <th>Ver Resumen</th>
                        <th>PDF</th>
                        <th>PDF</th>
                        <th>Anular Pedido</th>
                      </tr>
                    </thead>
                    <tbody>  <!--Creación tabla de productos-->
               
                        <?php foreach ($pedidos as $pedido): ?>
                      <tr>
                       
                          <td><?=  cambiaFormatoFecha($pedido['fecha_pedido']);?></td>
                       
                        <td><?= $pedido['estado'] ?>  </td>
                       
                        <td class="aa-cart-quantity"><?= $pedido['importeiva'] ?></td>
                        
                         <td><?= $pedido['direccion'] ?></td>
                      
                        <td><?= $pedido['cp'] ?> </td>
   
                        <td><span class="amount"><?=$pedido['nom_provincia']?></span></td>
                        <td><a href="<?= site_url() . "/Pedidos/MuestraResumen/" . $pedido['idPedido'] ?>" class="aa-add-to-cart-btn">Resumen</a></td>
                      
                        <td><a href="<?= site_url() . "/Pedidos/VerPDFPedido/" . $pedido['idPedido'] ?>" class="aa-add-to-cart-btn">Mostrar</a></td>
                       <td><a href="<?= site_url() . "/Pedidos/DescargarPDFPedido/" . $pedido['idPedido'] ?>" class="aa-add-to-cart-btn">Descargar</a></td>
                        <td><a class="remove" href="<?= site_url() . "/PedidosLista/AnularPedido/" . $pedido['idPedido'] ?>"><fa class="fa fa-close"></fa></a></td>
                      </tr>
                       <?php endforeach; ?>
                        <!--/Creación tabla de productos-->
                
                      </tbody>
                  </table>
                </div>
           </div>
         </div>
       </div>
     </div>
       <!--Error-->
               <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php if (!EMPTY($msg_error))
                    echo $msg_error;
                ?>
            </div>
        </div>
        
        <!-- PAGINACIÓN -->
        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    <nav>                              
                        <!-- PAGINATION CODEIGNITER -->
                        <?= $this->pagination->create_links(); ?>

                    </nav>                        
                </div>
            </div>
        </div>
   </div>
 </section>
 <!-- / Cart view section -->

        
