<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Login extends CI_Controller {

	public function __construct()
	{
	  	parent::__construct();
	  	$this->load->model('api_login_model');
	}

	public function twitter(){
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

		//received token info from twitter
		$_SESSION['token'] 			= $request_token['oauth_token'];
		$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];

		if($connection->http_code == 200){
            //get twitter connect url
			$url = $connection->getAuthorizeURL($request_token);
            //send them

			redirect($url);
		}else{
            //error here
			redirect('login_user');
		}
	}

	public function twitter_call_back(){
		if (isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {
			// if token is old, distroy any session and redirect user to index.php
			session_destroy();
			header('Location: ./login_user');
	
		}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

			//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
			$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			if($connection->http_code=='200') {
				//redirect user to twitter
				$_SESSION['status'] = 'verified';
				$_SESSION['request_vars'] = $access_token;

				//DB Insert
				$data = array(
					'api_id' => $access_token['user_id'],
					'f_name' => $access_token['screen_name'],
					'app_type' =>3,
				);
			$id = $access_token['user_id'];
			$this->api_login_model->insert_api_info($data,$id);
			$_SESSION['tw_status'] = $access_token['screen_name'];

			// unset no longer needed request tokens
				unset($_SESSION['token']);
				unset($_SESSION['token_secret']);
                $this->session->set_userdata( 'user_flash_msg_type', "success" );
                $this->session->set_flashdata('user_flash_msg', 'Sucessfully Login');
				redirect('home');
			}else{
				die("error, try again later!");
			}
		}else{
			die("error connecting to twitter! try again later!");
		}
	}

	public function gmail_call_back(){
		$gClient = new Google_Client();
		$gClient->setApplicationName('Job Portal');
		$gClient->setClientId(CLIENT_ID);
		$gClient->setClientSecret(CLIENT_SECRET);
		$gClient->setRedirectUri(REDIRECT_URI);
		$google_oauthV2 = new Google_Oauth2Service($gClient);

		if(isset($_REQUEST['code'])) {
			$gClient->authenticate();
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var(REDIRECT_URI, FILTER_SANITIZE_URL));
		}
		if (isset($_SESSION['token'])) {
			$gClient->setAccessToken($_SESSION['token']);
		}

		if ($gClient->getAccessToken()) {
			$userProfile = $google_oauthV2->userinfo->get();
			//DB Insert
			$data = array(
					'api_id'  => $userProfile['id'],
                    'f_name' => $userProfile['given_name'],
                    'l_name'  => $userProfile['family_name'],
                    'image'  	 => $userProfile['picture'],
                    'gender'     => $userProfile['gender'],
                    'app_type'   =>1,
                );
			$id = $userProfile['id'];
			$_SESSION['gmail_full_name'] = $userProfile['name'];

			$this->api_login_model->insert_api_info($data,$id);
				unset($_SESSION['token']);
                $this->session->set_userdata( 'user_flash_msg_type', "success" );
                $this->session->set_flashdata('user_flash_msg', 'Sucessfully Login');
				redirect('home');
		} else {
			$authUrl = $gClient->createAuthUrl();
		}
	}

	public function fb_callback(){
		$fb = new Facebook\Facebook([
		  'app_id' => '535759006585393', // Replace {app-id} with your app id
		  'app_secret' => '7b747f50721cd007c6b802f54d16793c',
		  'default_graph_version' => 'v2.2',
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		  $_SESSION['fb_access_token'] = (string) $accessToken;
		  $response = $fb->get('/me', $_SESSION['fb_access_token']);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		$fbData = $response->getGraphUser();

		//DB Insert
		$data = array(
			'api_id'  => $fbData['id'],
			'f_name' => $fbData['name'],
			'app_type'   =>2,
			);
		$id = $fbData['id'];
		$_SESSION['fb_status'] = $fbData['name'];

		$this->api_login_model->insert_api_info($data,$id);
		unset($_SESSION['fb_access_token']);
		$this->session->set_userdata( 'user_flash_msg_type', "success" );
		$this->session->set_flashdata('user_flash_msg', 'Sucessfully Login');
		redirect('home');
	}
}
