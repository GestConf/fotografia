<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-farmings">
                <h4><i class="fa fa-angle-right"></i> Eventos</h4>
                <div class="form-panel">
                    <div class="form">
                        <?php if (!empty($events)) : ?>
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre Anfitrion</th>
                                        <th>Evento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($events as $value) :
                                        ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $value["anfitrion"] ?></td>
                                            <td><?php echo $value["evento"] ?></td>
                                            <td>
                                                <a title="Ver Fotos" href="<?php echo base_url() ?>client/photos/<?php echo $value["IdEvent"] ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <h4><i class="fa fa-angle-right"></i> No existen Eventos registrados!</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
