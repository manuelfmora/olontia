<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Home</title>
    
    <!-- Font awesome -->
    <link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="<?=base_url()?>assets/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="<?=base_url()?>assets/css/theme-color/default-theme.css" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="<?=base_url()?>assets/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  

  </head>
  <body>
      <?php $this->session->set_userdata(array('URL' =>  current_url()));?>
   <!-- wpf loader Two -->
<!--    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> -->
    <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
 <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                <div class="aa-language">
                  <div class="dropdown">
                
                 
                  </div>
                </div>
                <!-- / language -->

                <!-- start currency -->

                 
                 <?= MuestraMonedas() ?> 
                 
                <!-- / currency -->
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>959-30-11-56</p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <?php if (SesionIniciadaCheck()): //Sesión iniciada ?> 
                  <!--Menú salir-->
                  <li> 
                          <div class="dropdown">
                              <a  href="#" type="button" id="dropdown-menu1 " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  <i></i>Hola: <?= $this->session->userdata('username'); ?>
                                  <span class="caret"></span>
                              </a>
                              <ul style="min-width: 60px;" class="dropdown-menu " aria-labelledby="dropdown-menu1" >
                                  <li><a href="<?= base_url() . 'index.php/Login/Logout' ?>">Salir</a></li>

                              </ul>
                          </div>
                      </li>
                      <!--Menú Opciones usuario-->
                       <li> 
                          <div class="dropdown">
                              <a  href="#" type="button" id="dropdown-menu1 " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  <i>Mi cuenta</i>
                                  <span class="caret"></span>
                              </a>
                              <ul style="min-width: 60px;" class="dropdown-menu " aria-labelledby="dropdown-menu1" >
                                  <li><a href="<?= base_url() . 'index.php/UserModify' ?>">Modificar Usuario</a></li>
                                  <li><a href="<?= base_url() . 'index.php/UserRemove' ?>">Eliminar Usuario</a></li>

                              </ul>
                             
                          </div>
                      </li>   
                  <li class="hidden-xs"><a href="<?=  base_url().'index.php/PedidosLista/ver'?>">Lista Pedidos</a></li>
                  <li class="hidden-xs"><a href="<?= base_url() . 'index.php/Cart'?>">Mi carrito</a></li>
                    <li> 
                       <div class="dropdown">
                           <a  href="#" type="button" id="dropdown-menu1 " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                               <i>XML</i>
                               <span class="caret"></span>
                           </a>
                           <ul style="min-width: 60px;" class="dropdown-menu " aria-labelledby="dropdown-menu1" >
                               <li><a href="<?= base_url() . 'index.php/Xml/importar' ?>">Importar XML</a></li>
                               <li><a href="<?= base_url() . 'index.php/Xml/exportar' ?>">Exportar XML</a></li>

                           </ul>

                       </div>
                   </li>  

                  <?php endif;?> 

                <?php if (!SesionIniciadaCheck()): //Sólo mostrar si la sesión iniciada ?>
                    <li><a href="<?= base_url() . 'index.php/Login' ?>" >Login</a></li>
                <?php endif; ?>

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
                <div class="aa-logo">
                <!-- Text based logo -->
                <a href="<?= base_url() . 'index.php/Main' ?>">
                  <span class="fa fa-shopping-cart"></span>
                  <p>Olontia<strong>Shop</strong> <span>Tu tienda de música</span></p>
                </a>
                <!-- img based logo -->
              
              </div>
                  
              <!-- / logo  -->
               <!-- cart box -->
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="<?= base_url() . 'index.php/Cart' ?>">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">CARRITO</span>
                   
                  <span class="aa-cart-notify"><?= $this->myCart->articulos_total() ?></span>
                </a>
                 <!--Vista del carrito en la página de inicio--> 
                <?php if($this->myCart->get_content()):?>
               
                <div class="aa-cartbox-summary">
                  <ul>                
                    <?php foreach ($this->myCart->get_content() as $items): ?>
                    <li>
                      <a class="aa-cartbox-img" href="<?= base_url() . 'index.php/VerCd/ver/' . $items['id'] ?>"><img src="<?= base_url() . 'assets/img/imgAPP/' . $items['opciones']['imagen'] ?>" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="<?= base_url() . 'index.php/VerCd/ver/' . $items['id'] ?>"><?= $items['nombre'] ?></a></h4>
                        <p><?= $items['cantidad'] ?> x <?= round($items['precio']*$this->session->userdata('rate'), 2).' '.$this->session->userdata('currency')?></p>
                      </div>
                      <a class="aa-remove-product" href="<?= base_url().'index.php/Cart/eliminar/'. $items['id']?>"><span class="fa fa-times"></span></a>
                    </li>
                     <?php endforeach; ?>              
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        <?=round($this->myCart->precio_total(),2)?>
                      </span>
                    </li>
                    
                    
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="<?= base_url().'index.php/Cart' ?>">Revisar</a>
                  
                </div>
                 <?php endif;?>
                

              </div>
              <!-- / cart box -->
                     
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <li><a href="<?= base_url() . 'index.php' ?>">Home</a></li>
              <li><a href="#">Categoria <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="<?= base_url() . 'index.php/category/ver/1'?>">Alternativa</a></li>
                  <li><a href="<?= base_url() . 'index.php/category/ver/2'?>">Pop</a></li>
                  <li><a href="<?= base_url() . 'index.php/category/ver/3'?>">Hip Hop</a></li>
                  <li><a href="<?= base_url() . 'index.php/category/ver/4'?>">Rock</a></li>                  
                  <li><a href="<?= base_url() . 'index.php/category/ver/5'?>">Electronica</a></li>                                       

                </ul>
              </li>
              <li><a href="<?= base_url() . 'index.php/cart'?>">Carrito </a></li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->
  
  <!-- CUERPO -->
      <?php
        if (isset($cuerpo))
            echo $cuerpo;
        ?>
  
  <!-- / CUERPO -->

  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>Envío gratis</h4>
                <P></P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>Devoluciones en 30 días</h4>
                <P></P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>Soporte 24/7</h4>
                <P></P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Menú Principal</h3>
                  <ul class="aa-footer-nav">
                    
                  <li><a href="<?= base_url() . 'index.php/category/ver/1'?>">Alternativa</a></li>
                  <li><a href="<?= base_url() . 'index.php/category/ver/2'?>">Pop</a></li>
                  <li><a href="<?= base_url() . 'index.php/category/ver/3'?>">Hip Hop</a></li>
                  <li><a href="<?= base_url() . 'index.php/category/ver/4'?>">Rock</a></li>                  
                  <li><a href="<?= base_url() . 'index.php/category/ver/5'?>">Electronica</a></li>                
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3></h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3></h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contáctenos</h3>
                    <address>
                      <p> Avda Andalucia,Huelva, Spain</p>
                      <p><span class="fa fa-phone"></span>959-30-11-56</p>
                      <p><span class="fa fa-envelope"></span>olontiashop@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                      <a href="#"><span class="fa fa-google-plus"></span></a>
                      <a href="#"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
<!--            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>-->
            <p>Diseñado por Manuel Francisco Mora Martín</p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?=base_url()?>assets/js/bootstrap.js"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.smartmenus.bootstrap.js"></script>  
  <!-- To Slider JS -->
  <script src="<?=base_url()?>assets/js/sequence.js"></script>
  <script src="<?=base_url()?>assets/js/sequence-theme.modern-slide-in.js"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.simpleGallery.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.simpleLens.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="<?=base_url()?>assets/js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="<?=base_url()?>assets/js/nouislider.js"></script>
  <!-- Custom js -->
  <script src="<?=base_url()?>assets/js/custom.js"></script> 

  </body>
</html>
