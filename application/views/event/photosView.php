<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <!--Panels of Phases-->
                <h3><i class="fa fa-angle-right"></i> <b>Fotos</b>
                    <div id="alert-order"></div>
                    <br>
                    <?php if (isset($source) && $source == "qr") { ?>
                        <span>
                            <a data-toggle="modal" href="#myModal" style="color: red !important;"> Iniciar Sesion</a>
                        </span>
                        <?php
                    } else {
                        $url = (GetFromSession("UserType") == "User") ? "dashboard" : "client";
                        ?>
                        <a class = "fa fa-arrow-left" href = "<?= base_url() . "$url/" ?>">Volver</a>
                    <?php }
                    ?>
                </h3>

                <div class="row">
                    <div class="form">
                        <?php foreach ($photos as $value) { ?>
                            <div class="col-md-4 mb">
                                <div>
                                    <img src="<?= base_url() . $value["UrlImage"] ?>" class="img-thumbnail" style="width: 50%">
                                </div>
                                <?php if (GetFromSession("UserType") == "User") { ?>
                                    <button type="button" class="btn btn-danger btn-xs btn-pedido"
                                            data-id="<?php echo $value["Id"] ?>"
                                            >
                                        <i class="fa fa-print"></i>Realizar Pedido
                                    </button>
                                <?php }
                                ?>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Iniciar Sesion</h4>
            </div>
            <div class="modal-body">
                <div class="login-wrap">
                    <div class="row">
                        <div class="col-xs-11 col-centered">
                            <label id="trial-expired" class="hide" style="color: #a94442"></label>
                        </div>
                    </div>
                    <a class="btn btn-danger btn-block" href="<?php echo base_url() . "user/withGoogle" ?>" type="submit">
                        <i class="fa fa-google-plus"></i> Google
                    </a>
                    <a class="btn btn-primary btn-block" href="<?php echo @$urlFacebook; ?>" type="submit">
                        <i class="fa fa-facebook"></i> Facebook
                    </a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->