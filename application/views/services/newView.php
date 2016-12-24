<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-employee">
                <h4><i class="fa fa-angle-right"></i> Asignar Evento</h4>
                <div class="form-panel">
                    <div class="form">
                        <form action="<?= base_url() ?>services/insert/" method="POST" class="cmxform form-horizontal style-form" id="clientForm">
                            <input type="hidden" value="<?php echo $client["Id"] ?>" name="IdClient"/>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Nombre Cliente</label>
                                <div class="col-lg-10">
                                    <?php echo $client["FullName"] ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Documento</label>
                                <div class="col-lg-10">
                                    <?php echo $client["Document"] ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Telefono</label>
                                <div class="col-lg-10">
                                    <?php echo $client["Phone"] ?>
                                </div>
                            </div>
                            <br>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Nombre Evento</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="name" name="Name" type="text" />
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