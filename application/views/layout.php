<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keyword" content="">
        <title><?= (isset($title) || $title !== '') ? $title : '::FotoEvents::' ?></title>
        <?php
        // CSS Resources
        includeCSSResources();
        ?>		
    </head>
    <body>
        <?php
        // Render the Top Nav and Left Menu if user is logged in
        if (GetFromSession('isloggedin')) {
            renderSection('top-menu');
            renderSection('left-menu');
        }

        /**
         * Include the page in Section variable coming from the controller
         * Check if the menus can be rendered by other variable, needs to be
         * created from the controller, etc.
         */
        renderSection($section);


        // JS Resources so pages can load faster
        includeJSResources();
        ?>
            <!--<script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>-->


        <!--common script for all pages-->
        <!--<script src="assets/js/common-scripts.js"></script>
        
        <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="assets/js/gritter-conf.js"></script>-->

        <!--script for this page-->
        <!--<script src="assets/js/sparkline-chart.js"></script>    
        <script src="assets/js/zabuto_calendar.js"></script>-->	

        <script type="text/javascript">
            $(document).ready(function () {
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Bienvenido a FotoEvents',
                    // (string | mandatory) the text inside the notification
                    text: 'Aplicacion Alfa en desarrollo',
                    // (string | optional) the image to display on the left
                    image: '<?= base_url() ?>/assets/images/user/<?= GetFromSession("UrlImage") ?>',
                                // (bool | optional) if you want it to fade out on its own or just sit there
                                sticky: true,
                                // (int | optional) the time you want it to be alive for before fading out
                                time: '',
                                // (string | optional) the class name you want to apply to that specific message
                                class_name: 'my-sticky-class'
                            });

                            return false;
                        });

                        var baseUrl = '<?= base_url() ?>';
                        var adminUrl = '<?= admin_url() ?>';
        </script>

        <script type = "text/javascript" >
            $(function () {
                jQuery(".fancybox").fancybox();
            });

        </script>

    </body>
</html>