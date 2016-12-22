<?php

class Account extends MZ_Controller {

    public function __construct() {
        parent::__construct();
        static::UserAuth();

        static::LoadModel('usermodel');
    }

    public function index() {
        $where = array(
            "email" => GetFromSession("email")
        );

        $settings = array(
            "title" => "Usuario",
            "section" => "account/mainView",
            "account" => static::Model()->get($where)
        );

        static::MakeView($settings);
    }

}
