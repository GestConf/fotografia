<?php

class Client extends MZ_Controller {

    public function __construct() {
        parent::__construct();

        static::UserAuth();

        static::LoadModel("clientmodel");
    }

    public function index() {
        $settings = array(
            "title" => "Clientes",
            "section" => "client/mainView",
            "clients" => static::Model()->getALL()
        );

        static::MakeView($settings);
    }

    public function create() {
        $settings = array(
            "title" => "Nuevo Cliente",
            "section" => "client/newView"
        );

        static::MakeView($settings);
    }

    public function insert() {
        $dataPost = GetAllPost();

        if (static::Model()->save($dataPost)) {
            redirect(base_url() . "client");
        }
    }

    public function events() {
        $id = GetFromSegment(3);

        $settings = array(
            "title" => "Eventos",
            "section" => "event/mainView",
            "events" => static::LoadModel("eventmodel")->getEvents($id)
        );

        static::MakeView($settings);
    }

    public function photos() {
        $idEvent = GetFromSegment(3);

        $settings = array(
            "title" => "Galeria",
            "section" => "event/photosView",
            "photos" => static::LoadModel("eventmodel")->gallery($idEvent)
        );

        static::MakeView($settings);
    }

}
