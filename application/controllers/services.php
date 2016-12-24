<?php

class Services extends MZ_Controller {

    public function __construct() {
        parent::__construct();
        static::UserAuth();
    }

    public function create() {
        $idClient = GetFromSegment(3);
        $settings = array(
            "title" => "Anhadir Servicio",
            "section" => "services/newView",
            "client" => static::LoadModel("clientmodel")->get($idClient)
        );

        static::MakeView($settings);
    }

    public function insert() {
        $dataPost = GetAllPost();

        if (static::LoadModel("eventmodel")->insert($dataPost)) {
            $hash = md5($dataPost->IdClient . $dataPost->Name);

            $path = "assets/images/$hash";

            if (!is_dir($path)) { //create the folder if it's not already exists
                if (mkdir($path, 0755, TRUE)) {
                    redirect(base_url() . "client/events/" . $dataPost->IdClient);
                }
            }
        }
    }

}
