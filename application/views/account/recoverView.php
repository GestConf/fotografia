<div id="login-page">
    <div class="container">
        <form action="<?php echo base_url() . "user/update" ?>" method="POST" class="form-login" id="loginForm">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"><a href="#" class="logo login-logo-size"><b>Fot<span>O</span></b></a></div>
                <div class="col-md-4"></div>
            </div>
            <!--<h2 class="form-login-heading">Inicia Sesion</h2>-->
            <div class="login-wrap">
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
                <input type="password" id="password" name="password" class="form-control" placeholder="Contrasena" autofocus="">
                <br>
                <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Actualizar</button>
            </div>
        </form>	  	

    </div>
</div>