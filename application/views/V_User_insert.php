<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="<?= base_url() . 'assets/img/imgAPP/header/header.jpg' ?>" alt="Registrarse img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>REGISTRARSE</h2>
                <ol class="breadcrumb">
                    <li><a href="<?php anchor('Main') ?>">Home</a></li>                   
                    <li class="active">Registrarse</li>
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
                        <div class="col-md-4">
                            <div class="aa-myaccount-login">
                                <h4>Login</h4>
                                <form class="aa-login-form" action="<?= base_url() . 'index.php/Login' ?>" method="POST">
                                    <label for="">Usuario<span>*</span></label>
                                    <input type="text" placeholder="Usuario" name="username" type="text" autofocus>
                                    <label for="">Password<span>*</span></label>
                                    <input type="password" placeholder="Password" name="clave" value="">
                                    <?php
                                    if (isset($error))
                                        echo $error;
                                    ?>
                                    <div class="form-group">
                                        <button class="aa-browse-btn " type="submit" value="entrar" name="entrar">Login</button>  
                                    </div>
                                    <label > </label>
                                    <p class="aa-lost-password"><a href="<?= base_url() . 'index.php/RestaurarClave' ?>">¿Olvidaste tu contraseña?</a></p>
                                

                                </form>
                            </div>
                        </div>
                        <div class="col-md-8"><!---->
                            <div class="aa-myaccount-register">                 
                                <h4>Registrarse</h4>
                                <form action="<?= base_url() . 'index.php/User_insert/Usuario' ?>" class="aa-login-form" method="post">
                                    <div id="customer_details" class="col2-set">

                                        <div class="woocommerce-billing-fields">

                                            <div id="" class="form-row form-row-first validate-required">
                                                <div class="col-md-5">
                                                    <label class="">Nombre de usuario:</label>
                                                    <input type="text" value="<?= set_value('nombre_usu') ?>" placeholder="Nombre de Usuario" id="billing_first_name" name="nombre_usu" class="input-text" maxlength="30">
                                                    <?= form_error('nombre_usu'); ?>

                                                </div>                           

                                                <div class="col-md-3">
                                                    <label class="">Contraseña:</label>
                                                    <input type="password" value="" style="width: 100%" placeholder="Contraseña" id="billing_first_name" name="clave" class="input-text">                                
                                                      <?php
                                                    if (!EMPTY($errorclave)) {
                                                        
                                                        echo $errorclave;                                                        
                                                        
                                                    }
                                                    if (EMPTY($errorclave)):?>
                                                       <?= form_error('clave'); ?>                                                    
                                                    <?php endif ?>  
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="">Repita Contraseña:</label>
                                                    <input type="password" value="" style="width: 100%" placeholder="Repita Contraseña" id="billing_first_name" name="rep_clave" class="input-text">                                
                                                          <?php
                                                    if (!EMPTY($errorclave)) {
                                                        
                                                        echo $errorclave;                                                      
                                                    }
                                                    if (EMPTY($errorclave)):?>                                                     
                                                       <?= form_error('rep_clave'); ?>
                                                    <?php endif ?> 
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="">Correo electrónico:</label>
                                                    <input type="text" value="<?= set_value('correo') ?>" placeholder="Correo de electrónico" id="billing_first_name" name="correo" class="input-text" maxlength="180">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                                  
                                                    <div class="col-md-4"><?= form_error('correo'); ?></div>
                                                </div>
                                               

                                                <div class="col-md-4">
                                                    <label class="">Nombre: </label>
                                                    <input type="text" value="<?= set_value('nombre_persona') ?>" placeholder="Nombre" id="billing_first_name" name="nombre_persona" class="input-text" maxlength="40"> 
                                                    <?= form_error('nombre_persona'); ?>
                                                </div>                         

                                                <div class="col-md-4">
                                                    <label class="">Apellidos: </label>
                                                    <input type="text" value="<?= set_value('apellidos_persona') ?>" placeholder="Apellidos" id="billing_first_name" name="apellidos_persona" class="input-text" maxlength="60"> 
                                                    <?= form_error('apellidos_persona'); ?>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="">DNI: </label>
                                                    <input type="text" value="<?= set_value('dni') ?>" placeholder="DNI" id="billing_first_name" name="dni" class="input-text" maxlength="9"> 
                                                    <?= form_error('dni'); ?>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-3"></div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <label class="">Dirección: </label>
                                                    <input type="text" value="<?= set_value('direccion') ?>" placeholder="Dirección" id="billing_first_name" name="direccion" class="input-text" maxlength="100"> 
                                                    <?= form_error('direccion'); ?>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="">Código Postal: </label>
                                                    <input type="text" value="<?= set_value('cp') ?>" placeholder="CP" id="billing_first_name" name="cp" class="input-text" maxlength="5"> 
                                                     <?= form_error('cp'); ?>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="">Provincia: </label>
                                                    <?= $select ?> 
                                                    <?= form_error('cod_provincia'); ?>
                                                </div>
                                             
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" id="place_order" name="GuardarUsuario" class="aa-browse-btn">Registrarse</button>  

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