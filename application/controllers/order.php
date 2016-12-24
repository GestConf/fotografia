<?php

class Order extends MZ_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $settings = array(
            "title" => "Pedidos",
            "section" => "order/mainView",
            "orders" => static::LoadModel("ordermodel")->getAll(GetFromSession("id"))
        );

        static::MakeView($settings);
    }

    public function insert() {
        $idGallery = $this->input->post("id");
        $idUser = GetFromSession("id");

        $data = array(
            "IdUser" => $idUser,
            "IdGallery" => $idGallery
        );
        $status = "error";

        $order = static::LoadModel("ordermodel")->get($data);

        if (!empty($order)) {
            $status = "info";
        } else if (static::LoadModel("ordermodel")->save($data)) {
            $status = "success";
        }

        $ajaxReponse = array(
            "status" => $status
        );

        echo AjaxResponse($ajaxReponse);
    }

    public function photos() {
        $idUser = GetFromSegment(3);

        $settings = array(
            "title" => "Galeria",
            "section" => "event/photosView",
            "photos" => static::LoadModel("ordermodel")->getPhotos($idUser)
        );

        static::MakeView($settings);
    }

}
