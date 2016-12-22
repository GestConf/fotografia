<?php

// Get a value from the ongoing session
if (!function_exists('GetFromSession')) {

    function GetFromSession($var) {
        $CI = & get_instance();

        return $CI->session->userdata($var);
    }

}

/**
 * Include Javascript Resources into Main Template 
 * */
if (!function_exists('includeJSResources')) {

    function includeJSResources() {

        $jsResources = array(
            //'assets/js/jquery-1.8.3.min',
            'assets/js/jquery',
            'assets/js/jquery-.min',
            'assets/js/bootstrap.min',
            'assets/js/jquery.dcjqaccordion.2.7',
            'assets/js/jquery.scrollTo.min',
            'assets/js/jquery.nicescroll',
            'assets/js/jquery.sparkline',
            'assets/js/common-scripts',
            'assets/js/jquery-ui-1.9.2.custom.min',
            'assets/js/gritter-conf',
            'assets/js/zabuto_calendar',
            'assets/js/jquery.backstretch.min',
            'assets/js/chart-master/Chart',
            'assets/js/bootstrap-datepicker',
            'assets/js/bootstrap-datetimepicker',
            'assets/js/date',
            'assets/js/daterangepicker',
            'assets/js/moment.min',
            'assets/js/bootstrap-timepicker',
            'assets/js/advanced-form-components',
            'js/javascript',
            'js/services',
            'js/api',
            'assets/js/bootstrap-switch',
            'assets/js/jquery.fancybox.js.download',
        );

        /*
         * Include gritter to display Welcome Message only when
         * a user is just logged in (dashboard)
         */
        if (GetFromSegment(1) === 'dashboard') {
            array_push($jsResources, 'assets/js/gritter/js/jquery.gritter');
        }

        foreach ($jsResources as $resource) {
            echo '<script type="text/javascript" src="' . base_url() . $resource . '.js"></script>';
        }

        // Custom js
        echo '
		<script>
            $.backstretch("assets/img/login-bg.jpg", {speed: 500});
        </script>';
    }

}

/**
 * Include CSS Resources into Main Template 
 * */
if (!function_exists('includeCSSResources')) {

    function includeCSSResources() {
        $cssResources = array(
            'assets/css/bootstrap',
            'assets/font-awesome/css/font-awesome',
            'assets/css/zabuto_calendar',
            'assets/js/gritter/css/jquery.gritter',
            'assets/css/style2',
            'assets/css/style',
            'assets/css/style-responsive',
            'assets/css/datepicker',
            'assets/css/daterangepicker',
            'assets/css/timepicker',
            'assets/css/bootstrap-switch',
        );

        foreach ($cssResources as $resource) {
            echo '<link rel="stylesheet" href="' . base_url() . $resource . '.css">';
        }

        // For IE Explorer
        echo ' 
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->';
    }

}

/**
 * Function to Render a Section page into Main Template
 * depending the module (controller/function)
 * NOTE: NOT FOR RENDER VIEWS FROM CONTROLLERS.
 * FOR THIS USE self::MakeView() method from Super_Controller
 * */
if (!function_exists('renderSection')) {

    function renderSection($section) {
        $CI = & get_instance();

        $CI->load->view($section);
    }

}


if (!function_exists('GetFromSegment')) {

    function GetFromSegment($segment) {
        $CI = & get_instance();

        return $CI->uri->segment($segment);
    }

}

// Return an object with the parameters encrypted
if (!function_exists('GetFromPostWithEncryptedPwd')) {

    function GetFromPostWithEncryptPwd($pwd, $pwd2 = null) {
        // How to sanitize each element??
        $post = $_POST;
        $obj = array();

        foreach ($post as $k => $v) {
            if ($pwd === $k || $pwd2 === $k) {
                $obj[$k] = $v;
            } else {
                $obj[$k] = $v;
            }
        }

        return (object) $obj;
    }

}


// Return a json encode response
if (!function_exists('AjaxResponse')) {

    function AjaxResponse($response) {
        header('Content-Type: application/json');
        return json_encode($response);
    }

}

// Get a given variable from $_POST array
if (!function_exists('GetFromPost')) {

    function GetFromPost($id) {
        $CI = & get_instance();

        return $CI->load->post($id);
    }

}

if (!function_exists('GetAllPost')) {

    function GetAllPost() {
        $post = $_POST;
        $obj = array();

        foreach ($post as $k => $v) {
            $obj[$k] = $v;
        }

        return (object) $obj;
    }

}

if (!function_exists("SetSession")) {

    function SetSession($key, $value) {
        $CI = & get_instance();

        $CI->session->set_flashdata($key, $value);
    }

}

if (!function_exists("GetSession")) {

    function GetSession($key) {
        $CI = & get_instance();

        return $CI->session->flashdata($key);
    }

}

if (!function_exists("EncodeData")) {

    function EncodeData($value) {//Encriptacion del Dato
        $CI = & get_instance();

        $value = json_encode($value);
        $value = $CI->encrypt->encode($value);
        $value = \str_replace(array("+", "/", "="), array("-", "_", ""), $value);
        return $value;
    }

}

if (!function_exists("DecodeData")) {

    function DecodeData($value, $assoc = false) {//Desencriptacion
        $CI = & get_instance();

        $value = \str_replace(array("-", "_", ""), array("+", "/", "="), $value);
        $value = $CI->encrypt->decode($value);
        $value = json_decode($value, $assoc);
        return $value;
    }

}

if (!function_exists('Modal')) {

    function Modal() {
        // Capitalize First Letter
        return <<<MODAL
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header-delete">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Atencion</h4>
					</div>
					<div class="modal-body">
						<div class='text-center' id="qr-img"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
					</div>
				</div>
			</div>
		</div>
MODAL;
    }

}
