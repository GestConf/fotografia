<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'libraries/Facebook/autoload.php';
require_once APPPATH . 'libraries/Facebook/Facebook.php';

class Main extends MZ_Controller {

    public function index() {
        static::UserAuth();

        $settings = array(
            'title' => 'Bienvenido a Fotos',
            'section' => 'main/mainView',
        );

        static::MakeView($settings);
    }

    public function signin() {
        static::UserAuth('dashboard');

        $settings = array(
            'title' => 'Inicia Sesion en Fotografia',
            'section' => 'main/signInView',
            "urlFacebook" => $this->urlFacebook()
        );

        static::MakeView($settings);
    }

    public function urlFacebook() {
        $this->config->load('api_facebook');
        
        $fb = new Facebook\Facebook([
            'app_id' => $this->config->item("id"), // Replace {app-id} with your app id
            'app_secret' => $this->config->item("secret"),
            'default_graph_version' => 'v2.6',
            'persistent_data_handler' => 'session'
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions

        $urlLogin = $helper->getLoginUrl(base_url() . "user/withFacebook", $permissions);

        return $urlLogin;
    }

}
