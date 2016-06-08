<!-- CUERPO -->

<div class="mm-product-area">    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <center>
                        <h4>Importar Categoría</h4>
                        <form method="post" action="<?= site_url() . '/Xml/ProcesaArchivo' ?>" enctype="multipart/form-data">
                            <label for="">Seleccione archivo<span>*</span></label><br><br>
                            <input type="file" name="archivo" class="aa-browse-btn" />
                            <br><br>
                            <div class="form-group-lg">
                                <button class="aa-browse-btn " type="submit" value="Enviar" >Enviar</button> 
                            </div>                

                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>