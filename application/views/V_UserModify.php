<!-- catg header banner section -->
<section   id="aa-catg-head-banner">
    <img src="<?= base_url() . 'assets/img/imgAPP/header/coldplay.jpg' ?>" style="right: 90px ; " alt="Registrarse img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>MODIFICAR USUARIO</h2>
                <ol class="breadcrumb">
                    <li><a href="<?php anchor('Main') ?>">Home</a></li>                   
                    <li class="active">Account</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="aa-myaccount">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area">         
                    <div class="row">
                    
                        <div class="col-md-12"><!---->
                            <div class="aa-myaccount-register">                 
                                <h4>Modificar Usuario</h4>
                                <form action="<?= base_url() . 'index.php/UserModify/Modificar' ?>" class="aa-login-form" method="post">
                                    <div id="customer_details" class="col2-set">

                                        <div class="woocommerce-billing-fields">

                                            <div id="" class="form-row form-row-first validate-required">
                                                <div class="col-md-12">
                                                    <div class="col-md-5">
                                                        <label class="">Nombre de usuario:<span>*</span></label>
                                                        <input type="text" value="<?= $datos['nombre_usu'] ?>" placeholder="Nombre de Usuario" id="billing_first_name" name="nombre_usu" class="input-text" >
                                                        <?= form_error('nombre_usu'); ?>

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="">Contraseña:<span>*</span></label>
                                                    <input type="password" value="" style="width: 100%" placeholder="Contraseña" id="billing_first_name" name="clave" class="input-text">                                
                                                     <?= form_error('clave'); ?>
                                                </div>
                                                  <div class="col-md-3">
                                                    <label class="">Contraseña Nueva:</label>
                                                    <input type="password" value="" style="width: 100%" placeholder="Contraseña Nueva" id="billing_first_name" name="clave_nueva" class="input-text">                                
                                                      <?php
                                                    if (!EMPTY($errorclavenuevo)) {
                                                        
                                                        echo $errorclavenuevo;                                                        
                                                        
                                                    }?>
                                                    <?php
                                                    if (!EMPTY($errorclave)) {
                                                        
                                                        echo $errorclave;                                                        
                                                        
                                                    }?>                                 
                                                                                             
                                                     
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="">Repita Contraseña Nueva:</label>
                                                    <input type="password" value="" style="width: 100%" placeholder="Repita Contraseña Nueva" id="billing_first_name" name="rep_clave_nueva" class="input-text">                                
                                                          <?php
                                                    if (!EMPTY($errorclaverep)) {
                                                        
                                                        echo $errorclaverep;                                                      
                                                    }?> 
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="">Correo electrónico:<span>*</span></label>
                                                    <input type="text" value="<?= $datos['correo'] ?>" placeholder="Correo de electrónico" id="billing_first_name" name="correo" class="input-text" maxlength="180">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                                  
                                                    <div class="col-md-4"><?= form_error('correo'); ?></div>
                                                </div>                        

                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-3"></div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <label class="">Dirección:<span>*</span> </label>
                                                    <input type="text" value="<?= $datos['direccion'] ?>" placeholder="Dirección" id="billing_first_name" name="direccion" class="input-text" maxlength="100"> 
                                                    <?= form_error('direccion'); ?>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="">Código Postal:<span>*</span> </label>
                                                    <input type="text" value="<?= $datos['cp'] ?>" placeholder="CP" id="billing_first_name" name="cp" class="input-text" maxlength="5"> 
                                                     <?= form_error('cp'); ?>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="">Provincia:<span>*</span> </label><br>
                                                    <?= $select ?> 
                                                    <?= form_error('cod_provincia'); ?>
                                                </div>
                                             
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <button type="submit" id="place_order" value="Guardar Usuario"  name="GuardarUsuario" class="aa-browse-btn">Guardar Cambios</button>  

                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div><!---->
                    </div>          
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Cart view section -->