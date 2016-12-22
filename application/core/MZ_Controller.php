<?php

class MZ_Controller extends CI_Controller {

    /** Default Template as Constant * */
    const DEFAULT_LAYOUT = 'layout';

    /** Default Trial Days */
    const DEFAULT_TRIAL_DAYS = 30;

    /** @var XC_Controller $instance */
    private static $instance;

    /** Custom Layout * */
    private static $layout = '';

    /** Have the Model Instance * */
    protected static $model;

    /** Have the Library Name Instance * */
    protected static $lib;

    /** Call Parent Construct from CI_Controller * */
    public function __construct() {
        parent::__construct();
        self::$layout = self::DEFAULT_LAYOUT;
    }

    /**
     * This method replace the normal $this->load->view
     * in order to have a clear method to call instead
     * */
    protected function MakeView($settings = null) {
        $this->load->view(self::$layout, $settings);
    }

    /**
     * Custom Model Loader
     * */
    protected function LoadModel($name) {
        $this->load->model($name);

        self::$model = $this->$name;

        return self::$model;
    }

    /**
     * Return the model instance
     *
     * @return mixed
     */
    protected function Model() {
        return self::$model;
    }

    /**
     * Custom Library Loader
     * */
    protected function LoadLibrary($name) {
        $this->load->library($name);

        self::$lib = $this->$name;

        return self::$lib;
    }

    /**
     * Deprecated for now
     */
    protected function LoggedIn($url = null) {

        if (!is_null($url)) {

            redirect(base_url() . $url);

            return true;
        }

        if (!GetFromSession('is_logged_in')) {

            redirect(base_url() . 'main/signin');
        }
    }

    /**
     * Create User Auth Helper
     */
    protected function UserAuth($url = '') {
        // Need Validate the User is loggedIn
        // SuperUser, Administrator, Normal
        if (GetFromSession('UserType') === 'SuperUser') {
            redirect(admin_url());
        }
        // Validate if some user session is validated
        if (!GetFromSession('isloggedin') && $url === '') {
            // No User logged In.
            // Send it to Sign In View
            redirect(base_url() . 'main/signin');
        } elseif (GetFromSession('isloggedin') && $url !== '') {
            // Redirect to some url provided
            redirect(base_url() . $url);
        }

        // User authentication successfully
        return true;
    }

    public static function &get_instance() {
        return self::$instance;
    }

    /**
     * Validate if the user is allow to modify company data
     */
    protected function isDefault() {
        $userId = GetFromSession('Id');
        $companyId = static::getTenant();
        $this->isDefault = (int) static::LoadModel('usermodel')->isDefault($userId, $companyId);

        if (!$this->isDefault) {
            redirect(base_url() . 'dashboard');
        }
    }

}
