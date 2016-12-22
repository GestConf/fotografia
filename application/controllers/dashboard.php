<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MZ_Controller {

    public function __construct() {
        parent::__construct();
        static::UserAuth();
    }

    public function index() {

        $settings = array(
            'title' => 'Dashboard ' . GetFromSession('source_registration'),
            'section' => 'dashboard/mainView',
        );

        $userType = GetFromSession("UserType");
        if ($userType == "User") {
            $settings["events"] = static::LoadModel("eventmodel")->getEventsUser(GetFromSession("id"));
        }

        static::MakeView($settings);
    }

}
