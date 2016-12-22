<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-farmings">
                <h4><i class="fa fa-angle-right"></i> Clientes</h4>
                <div class="form-panel">
                    <div class="form">
                        <?php if (!empty($clients)) : ?>
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Nro. Telefono</th>
                                        <th>Documento</th>
                                        <th>Correo Electronico</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($clients as $client) :
                                        ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $client["FullName"] ?></td>
                                            <td><?php echo $client["Document"] ?></td>
                                            <td><?php echo $client["Phone"] ?></td>
                                            <td><?php echo $client["Email"] ?></td>
                                            <td>
                                                <a title="Eventos" href="<?php echo base_url() ?>client/events/<?php echo $client["Id"] ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                                <a title="Servicio" href="<?php echo base_url() ?>services/create/<?php echo $client["Id"] ?>" class="btn btn-danger btn-xs"><i class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <h4><i class="fa fa-angle-right"></i> No existen Clientes registrados!</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            renderSection('client/rightMenuView');
            ?>
        </div>
    </section>
</section>