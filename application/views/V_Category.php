
 <!-- Vista que aparece al inicio de la aplicación -->
<!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            <?php foreach ($banner as $key => $producto) : ?>
            <li>
              <div class="seq-model">
                <img data-seq src="<?= base_url() . 'assets/img/imgAPP/' . $producto['imagen']?>" alt="">                
              </div>
              <div class="seq-title">
               <span data-seq>últimas</span>                
                <h2 data-seq>Novedades</h2>                
                <p data-seq></p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">COMPRA AHORA</a>
              </div>
            </li>
            
            <?php endforeach; ?>  
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
 
  <!-- / slider --> 
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class= col-xs-12 col-md-8>
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                    <li><a href="<?= base_url() . 'index.php/category/ver/1'?>">Alternativa</a></li>
                    <li><a href="<?= base_url() . 'index.php/category/ver/2'?>" >Pop</a></li>
                    <li><a href="<?= base_url() . 'index.php/category/ver/3'?>" >Hip Hop</a></li>
                    <li><a href="<?= base_url() . 'index.php/category/ver/4'?>" >Rock</a></li>
                    <li><a href="<?= base_url() . 'index.php/category/ver/5'?>" >Electronica</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    <div class="tab-pane fade in active" id="men">
                        <h2><?php if(isset($titulo)) echo $titulo ?></h2><br>
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
                        
   <!--PRODUCTO-->     <?php foreach ($productos as $key => $producto) : ?>              
          <!--Comprobamos que las imagenes pertenecen a la carpeta BANNER -->  
                           <?php if($producto['seleccionado']!=2):?>
<!--PRODUC NO BANNERS--> <li>
                          <figure>
                            <a class="aa-product-img" href="<?= base_url().'index.php/VerCd/ver/'.$producto['idProducto']?>"><img src="<?= base_url() . 'assets/img/imgAPP/' . $producto['imagen'] ?>"></a>
                            <a class="aa-add-card-btn"href="<?= site_url() . '/Cart/comprar/' . $producto['idProducto'] ?>"><span class="fa fa-shopping-cart"></span>Añadir al carro</a>
                              <figcaption>
                                  <h6 class="aa-product-title"><a href="<?= base_url().'index.php/VerCd/ver/'.$producto['idProducto']?>"><?php echo $producto['nombre_pro'];?></a></h6>
                              <span class="aa-product-price"> <?php MostrarDescuento($producto['precio'], $producto['descuento']) ?></span>
                            </figcaption>
                            
                          </figure>                        
                          <div class="aa-product-hvr-content">
     <!---->                <a href="<?= base_url().'index.php/VerCd/ver/'.$producto['idProducto']?>" data-toggle2="tooltip" data-placement="top" title="Vista Rapida" data-toggle="modal" ><span class="fa fa-search"></span></a>   
                          </div>
                          <!-- product badge -->                                            
                          <?php if($producto['descuento']!= '0.00'): ?>
                          
                          <span class="aa-badge aa-sold-out" href="#">Oferta!</span>
                          
                          <?php endif;?>
                        </li>
                        <?php endif; ?>
   <!--/PRODUCTO-->     <?php endforeach; ?>  
                       <!-- start single product item -->

                      </ul>
                    </div>
                    <!-- / men product category -->
                  </div>
              </div>
            </div>
          </div>
        </div>      
      </div>
     </div>
  </section>
  <!-- / Products section -->
     <!-- PAGINACIÓN -->
       <div class="product-pagination text-center">
                    <nav>                              
                       
                        <?= $this->pagination->create_links(); ?>

                    </nav>                        
           </div>





  
  