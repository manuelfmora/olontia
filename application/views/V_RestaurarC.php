<?php
/*
 * VISTA que pide el nombre de usuario para restablecer la contraseña en la aplicación a tráves del correo.
 */
?>
<!-- CUERPO-->
<div class="mm-product-area">
    <h4 style="text-align: center; color: #ff6666; ">Si has olvidado tu contraseña, ¡No te preocupes!<br> Introduce nombre tu de usuario y te enviaremos una nueva.</h4>
    <div style="padding-bottom: 100px;" class="container">
        <div class="row">
            <div class="col-sm-8 col-md-4 col-md-offset-4">
                <div class="panel panel-default">


                    <h4>Restablecer Contraseña</h4>
                    <div class="alert alert-danger"></div>
                    <form class="aa-login-form" action="" method="POST">
                        <label for="">Usuario<span>*</span></label>
                        <input type="text" placeholder="Usuario" name="username" type="text" autofocus>                        
                        <?= form_error('username'); ?>
                        <div class="form-group">
                            <button   class="aa-browse-btn" type="submit" value="entrar" name="entrar">Enviar</button>  
                        </div>
                        <label > </label>
                        <p></p>

                        <div style="padding-top: 25px;" class="aa-register-now">
                            ¿No tienes una cuenta?<a style="color: #ff6666; " href="<?= base_url() . 'index.php/User_insert' ?>">Registrate ahora!</a>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
