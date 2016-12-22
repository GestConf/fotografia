<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-employee">
                <h4><i class="fa fa-angle-right"></i> Nuevo Cliente</h4>
                <div class="form-panel">
                    <div class="form">
                        <form action="<?= base_url() ?>client/insert/" method="POST" class="cmxform form-horizontal style-form" id="clientForm">
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Nombre</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="name" name="FullName" type="text" required="true"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Documento</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="document" name="Document" type="number" required="true"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="Phone" class="control-label col-lg-2">Telefono</label>
                                <div class="col-lg-10">
                                    <input type="number" class=" form-control" id="Phone" name="Phone" required="true"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Correo Electronico</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="email" name="Email" type="email" required="true"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-theme" type="submit">Guardar</button>
                                    <a href="<?= base_url() ?>client/" class="btn btn-theme04" type="button">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            renderSection('client/rightMenuView');
            ?>
    </section>
</section>