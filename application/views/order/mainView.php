<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-farmings">
                <h4><i class="fa fa-angle-right"></i> Pedidos</h4>
                <div class="form-panel">
                    <div class="form">
                        <?php if (!empty($orders)) : ?>
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Usuario</th>
                                        <th>Evento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($orders as $value) :
                                        ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $value["user_name"] ?></td>
                                            <td><?php echo $value["evento"] ?></td>
                                            <td>
                                                <a title="Ver Fotos" href="<?php echo base_url() ?>order/photos/<?php echo $value["IdUser"] ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <h4><i class="fa fa-angle-right"></i> No existen Pedidos registrados!</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</section>