<?php /*
 * VISTA que pide usuario y contraseña para iniciar sesión en la aplicación con la opción de registrarse en la página o restablecer la contraseña.
 */
?>
<!-- CUERPO -->

<div class="mm-product-area">    
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-4 col-md-offset-4">
                <div class="panel panel-default">


                    <h4>Login o Registrarse</h4>
                    <form class="aa-login-form" action="<?= base_url() . 'index.php/Login' ?>" method="POST">
                        <label for="">Usuario<span>*</span></label>
                        <input type="text" placeholder="Usuario" name="username" type="text" autofocus>
                        <label for="">Password<span>*</span></label>
                        <input type="password" placeholder="Password" name="clave" value="">
                        <?php
                        if (isset($error))
                            echo $error;
                        ?>
                        <center>
                            <div class="form-group">
                                <button class="aa-browse-btn " type="submit" value="entrar" name="entrar">Login</button>  
                            </div>
                        </center>
                        <label > </label>
                        <p class="aa-lost-password"><a href="<?=  base_url().'index.php/RestaurarClave'?>">¿Olvidaste tu contraseña?</a></p>
                        <div class="aa-register-now">
                            ¿No tienes una cuenta?<a style="color: #ff6666;" href="<?= base_url() . 'index.php/User_insert' ?>">Registrate ahora!</a>
                        </div>
               
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!--   Login Modal   
