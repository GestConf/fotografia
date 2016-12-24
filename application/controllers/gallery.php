<?php

require_once APPPATH . 'libraries/Facebook/autoload.php';
require_once APPPATH . 'libraries/Facebook/Facebook.php';

class Gallery extends MZ_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function photos() {
        $idEvent = GetFromSegment(3);

        $settings = array(
            "title" => "Galeria",
            "section" => "event/photosView",
            "source" => "qr",
            "photos" => static::LoadModel("eventmodel")->gallery(DecodeData($idEvent)),
            "urlFacebook" => $this->urlFacebook()
        );

        $ipUser = $_SERVER['REMOTE_ADDR'];
        $this->db->insert("session", array("IpUser" => $ipUser, "IdEvent" => DecodeData($idEvent)));

        static::MakeView($settings);
    }

    private function urlFacebook() {
        $fb = new Facebook\Facebook([
            'app_id' => '748280885337934', // Replace {app-id} with your app id
            'app_secret' => '45cc254f8d7dc8e41dd6795f587d9f33',
            'default_graph_version' => 'v2.6',
            'persistent_data_handler' => 'session'
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions

        $urlLogin = $helper->getLoginUrl(base_url() . "user/withFacebook", $permissions);

        return $urlLogin;
    }

    public function getPhotos() {
        $photos = static::LoadModel("gallerymodel")->getAll();

        foreach ($photos as &$value) {
            $value["UrlImage"] = base_url() . $value["UrlImage"];
        }

        echo json_encode($photos);
    }

}
