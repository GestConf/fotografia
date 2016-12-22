<?php

if (!function_exists('AppInitialize')) {

    // Agricola initializing...
    function AppInitialize($userData) {
        // Get CI reference
        $CI = & get_instance();

        // Create User Session
        $userData['isloggedin'] = true;
        $CI->session->set_userdata($userData);

        return $CI->session->all_userdata();
    }

}

if (!function_exists('AppShutDown')) {

    // Shuting down the app, sending the user to main page
    // with session destroyed...
    function AppShutDown() {
        // Get CI reference
        $CI = & get_instance();

        // Destroy the session
        $CI->session->sess_destroy();

        // Redirect to main page
        redirect(base_url() . 'main');
    }

}
