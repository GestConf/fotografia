<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'libraries/Facebook/autoload.php';
require_once APPPATH . 'libraries/Facebook/Facebook.php';

class User extends MZ_Controller {

    private $HOST_PHPMAILER = "smtp.gmail.com";
    private $PUERTO_PHPMAILER = "465";
    private $USUARIO_PHPMAILER = " noreplyfotos2016@gmail.com";
    private $PASSWORD_PHPMAILER = "prueba.2016";
    private $REMITENTE_PHPMAILER = " noreplyfotos2016@gmail.com";
    private $NOMBRE_REMITENTE_PHPMAILER = "FOTOS";
    private $SMTPSECURE_PHPMAILER = "ssl";

    public function __construct() {
        parent::__construct();
        // Load User Model
        static::LoadModel('usermodel');
    }

    public function login() {
        // User Credential		
        $credential = GetFromPostWithEncryptPwd('password');

        // Successful
        if ($userData = static::Model()->validateCredentials($credential)) {
            // Go to Dashboard. Welcome to Agricola!
            print AjaxResponse(AppInitialize($userData));
        }
    }

    public function logout() {
        // Validate if is logged In
        static::UserAuth();

        // Shutdown the application
        AppShutDown();
    }

    public function withGoogle() {
        //params
        $this->config->load('api');
        $clientId = $this->config->item('id');
        $clientSecret = $this->config->item("secret");
        $redirectUri = $this->config->item("redirect_uri");
        //end params
        $this->load->library('google');
        $this->google->load("Google/Client");
        $client = new Google_Client();

        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);

        $client->setDeveloperKey($redirectUri);
        $client->setApprovalPrompt('force');

        $client->addScope(array(
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/userinfo.email'
        ));

        //procede auth    
        $this->google->load('Google/Service/Oauth2');
        $google_oauthV2 = new Google_Service_Oauth2($client);
        if (!$this->input->get('code')) {
            $authUrl = $client->createAuthUrl();
            redirect($authUrl);
        } else {
            $client->authenticate($this->input->get('code'));
            $user = $google_oauthV2->userinfo->get();

            $userData = array(
                "email" => $user['email'],
                "registration_date" => date("Y-m-d"),
                "url_image" => $user["picture"],
                "source_registration" => "Google",
                "password" => NULL,
                "user_name" => $user["name"],
                "UserType" => "User"
            );

            $this->insertUser($userData);
        }
    }

    public function withFacebook() {
        $this->config->load('api_facebook');
        
        $fb = new Facebook\Facebook([
            'app_id' => $this->config->item("id"), // Replace {app-id} with your app id
            'app_secret' => $this->config->item("secret"),
            'default_graph_version' => 'v2.6',
            'persistent_data_handler' => 'session'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $_SESSION['FBRLH_state'] = $_GET['state'];

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error  

            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues  

            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }


        try {
            // Get the Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());
            //  print_r($response);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'ERROR: Graph ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'ERROR: validation fails ' . $e->getMessage();
            exit;
        }

        $userNode = $response->getGraphUser();

        $userData = array(
            "email" => $userNode['email'],
            "registration_date" => date("Y-m-d"),
            "url_image" => "//graph.facebook.com/" . $userNode["id"] . "/picture",
            "source_registration" => "Facebook",
            "password" => NULL,
            "user_name" => $userNode["name"],
            "UserType" => "User"
        );

        $this->insertUser($userData);
    }

    private function insertUser($userData) {
        $where = array(
            "email" => $userData["email"]
        );

        $infoUser = static::Model()->get($where);
        $idUser = -1;

        if (!empty($infoUser)) {
            $this->insertEvents($infoUser["id"]);
            AppInitialize($infoUser);
            redirect(base_url() . "dashboard");
        } else {
            $idUser = static::Model()->insert($userData);
            if ($idUser != -1) {
                $this->insertEvents($idUser);
                AppInitialize($userData);
                redirect(base_url() . "dashboard");
            }
        }
    }

    private function insertEvents($idUser) {
        $ipUser = $_SERVER['REMOTE_ADDR'];

        $sql = "select * from session where IpUser = ? and IdEvent is not NULL";
        $query = $this->db->query($sql, array($ipUser));
        $result = $query->result_array();

        foreach ($result as $value) {
            $data = array(
                "IdUser" => $idUser,
                "IdEvent" => $value["IdEvent"]
            );

            static::LoadModel("eventmodel")->insertUserEvent($data);
        }

        static::LoadModel("usermodel")->deleteSessions($ipUser);
    }

    public function recoverPassword() {
        $email = $this->input->post("email");

        $where = array(
            "email" => $email
        );

        $user = static::Model()->get($where);

        $status = "error";

        if (!empty($user)) {
            $url = base_url() . "user/updatePassword/" . $this->encode_filtrado($user["id"]);

            $message = "<b>Usuario/Email:<b> " . $user["email"] . "<br><br>";
            $message.= "<b>Click Aqui para Restaurar Contrasenha:<b> " . $url;

            $this->_sendMail("Recuperar Contrasenha", $email, $message);
            $status = "success";
        }

        $ajaxReponse = array(
            "status" => $status
        );

        echo AjaxResponse($ajaxReponse);
    }

    public function updatePassword() {
        $idEncode = GetFromSegment(3);

        if (!empty($idEncode)) {
            $settings = array(
                "title" => "Actualizar Contrasenha",
                "section" => "account/recoverView",
                "id" => $this->decode_filtrado($idEncode)
            );

            static::MakeView($settings);
        } else {
            redirect(base_url());
        }
    }

    public function update() {
        $data = GetAllPost();

        if (static::Model()->update($data)) {
            redirect(base_url());
        }
    }

    protected function encode_filtrado($value) {//Encriptacion del Dato
        $value = json_encode($value);
        $value = $this->encrypt->encode($value);
        $value = \str_replace(array("+", "/", "="), array("-", "_", ""), $value);
        return $value;
    }

    protected function decode_filtrado($value, $assoc = false) {//Desencriptacion
        $value = \str_replace(array("-", "_", ""), array("+", "/", "="), $value);
        $value = $this->encrypt->decode($value);
        $value = json_decode($value, $assoc);
        return $value;
    }

    private function _sendMail($asunto, $destinatario, $mensaje) {
        $this->load->library('mail');
        $vrespuesta = array();
        $mail = new PHPMailer();
        $mail->SetLanguage("es", "");
        $mail->IsSMTP();
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = $this->SMTPSECURE_PHPMAILER;
        $mail->Host = $this->HOST_PHPMAILER;
        $mail->Port = $this->PUERTO_PHPMAILER;
        $mail->Mailer = "smtp";
        $mail->Username = $this->USUARIO_PHPMAILER;
        $mail->Password = $this->PASSWORD_PHPMAILER; //fin de configuracion de servidor smtp
        $mail->From = $this->REMITENTE_PHPMAILER; //inicio envio de correo
        $mail->FromName = $this->NOMBRE_REMITENTE_PHPMAILER;
        $mail->Subject = $asunto;
        $mail->AltBody = $mensaje;
        $mail->MsgHTML($mensaje);
        $mail->AddAddress($destinatario);
        $mail->IsHTML(TRUE);

        if (!$mail->Send()) //fin de envio de correo
            $vrespuesta = array("respuesta_envio" => FALSE, "error" => $mail->ErrorInfo);
        else
            $vrespuesta = array("respuesta_envio" => TRUE, "error" => $mail->ErrorInfo);

        $mail->ClearAddresses();
        $mail->SmtpClose();
        return $vrespuesta;
    }

}
