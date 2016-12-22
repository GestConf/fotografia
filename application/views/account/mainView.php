<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-employee">
                <h4><i class="fa fa-angle-right"></i> Informacion</h4>
                <div class="form-panel">
                    <div class="form cmxform form-horizontal style-form">
                        <div class="form-group ">
                            <label for="size" class="control-label col-lg-2">Nombre</label>
                            <div class="col-lg-10">
                                <input class=" form-control" id="firstname" name="user_name" type="text" value="<?= $account["user_name"] ?>"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="size" class="control-label col-lg-2">Correo</label>
                            <div class="col-lg-10">
                                <input class=" form-control" id="lastname" name="email" type="text" value="<?= $account["email"] ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <a href="<?= base_url() ?>dashboard/" class="btn btn-theme04" type="button">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</section>