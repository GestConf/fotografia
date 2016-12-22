<div id="login-page">
    <div class="container">
        <form class="form-login" id="loginForm">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"><a href="#" class="logo login-logo-size"><b>Foto<span>Event</span></b></a></div>
                <div class="col-md-4"></div>
            </div>
            <!--<h2 class="form-login-heading">Inicia Sesion</h2>-->
            <div class="login-wrap">
                <div class="row">
                    <div class="col-xs-11 col-centered">
                        <label id="trial-expired" class="hide" style="color: #a94442"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-11 col-centered">
                        <label id="bad-credentials" class="hide">Credenciales incorrectas. Revisa tus datos</label>
                    </div>
                </div>
                <input type="text" id="user" class="form-control" placeholder="Email o Usuario" autofocus>
                <br>
                <input type="password" id="password" class="form-control" placeholder="Contrasena">
                <label class="checkbox">
                    <!--<input type="checkbox" value="remember-me"> Remember me-->
                    <span class="pull-right">
                        <a data-toggle="modal" href="#myModal" style="color: white !important;"> Olvidaste tu contrasena?</a>

                    </span>
                </label>
                <button class="btn btn-theme btn-block login-btn" href="index.html" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                <a class="btn btn-danger btn-block" href="<?php echo base_url() . "user/withGoogle" ?>" type="submit">
                    <i class="fa fa-google-plus"></i> Google
                </a>
                <a class="btn btn-primary btn-block" href="<?php echo $urlFacebook; ?>" type="submit">
                    <i class="fa fa-facebook"></i> Facebook
                </a>
                <hr>
                <!--
                <div class="registration">
                    Don't have an account yet?<br/>
                    <a class="" href="#">
                        Create an account
                    </a>
                </div>
                -->
            </div>

            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Olvidaste tu Contrasena?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Ingresar tu Correo Electronico</p>
                            <div class="form-group ">
                                <div class="col-lg-10">
                                    <input class=" form-control" id="email" name="email" type="text" />
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div id="alert-recover"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-theme btn-recover-password">
                                Continuar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

        </form>	  	

    </div>
</div>