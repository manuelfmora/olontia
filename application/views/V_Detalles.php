<!-- Muestra el producto...
     Descripcon y cantidad a comprar.
-->                  

<div class="mm-product-area">

    <div class="container">


        <div class="row">
            <!-- Modal view slider -->

            <div class="col-md-6 col-sm-6 col-xs-12">                              
                <div class="aa-product-view-slider">                                
                    <div class="simpleLens-gallery-container" id="demo-1">
                        <div class="simpleLens-container">
                            <div class="simpleLens-big-image-container">
                                <a>
                                    <img src="<?= base_url() . 'assets/img/imgAPP/' . $producto['imagen'] ?>" class="simpleLens-big-image">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal view content -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="aa-product-view-content">
                    <h3><?= $producto['nombre_pro'] ?></h3>
                    <div class="aa-price-block">
                        <span class="aa-product-price">   <?= MostrarDescuento($producto['precio'], $producto['descuento']) ?></span>
                        <p class="aa-product-avilability">Stock: <span style="color:#ff6666;"><?= $producto['stock'] . ' UND.' ?></span></p>
                    </div>
                    <p><?= $producto['descripcion'] ?></p>
                    <p class="aa-prod-category">
                        Categoria: <a style="color:#ff6666;" href="#"><?= $categoria ?></a>
                    </p>         
                    <div class="aa-prod-quantity">
                        <!--Formulario-->
                        <form action="<?= site_url() . '/Cart/comprar/' . $producto['idProducto'] ?>" method="POST" class="cart">
                            <select name="cantidadProd" id="">

                                <?php
                                for ($i = 1; $i <= $producto['stock']; $i++) {

                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>

                            </select>
                            <div class="aa-prod-view-bottom">
                                <button type="submit" class="aa-add-to-cart-btn" name="guardar" ><span class="fa fa-shopping-cart"></span>Añadir al carrito</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

