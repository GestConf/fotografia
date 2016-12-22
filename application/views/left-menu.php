<!-- **********************************************************************************************************************************************************
                        MAIN SIDEBAR MENU
 *********************************************************************************************************************************************************** -->
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered">
                <a href="<?= base_url("account") ?>">
                    <img 
                        src=""
                        class="img-circle 
                        item-img" 
                        width="80">
                </a>
            </p>
            <h5 class="centered"><?php echo GetFromSession('user_name'); ?></h5>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-tasks"></i>
                    <span>Administracion</span>
                </a>
                <?php
                if (GetFromSession("UserType") == "Admin") {
                    ?>
                    <ul class="sub">
                        <li><a  href="<?= base_url() ?>client">Clientes</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a  href="<?= base_url() ?>order">Pedidos</a></li>
                    </ul>
                <?php } ?>

                <?php if (GetFromSession("UserType") == "User") { ?>
                    <ul class="sub">
                        <li><a  href="<?= base_url() ?>dashboard">Mis Eventos</a></li>
                    </ul>
                <?php }
                ?>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
