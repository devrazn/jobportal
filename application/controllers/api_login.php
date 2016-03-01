<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('include_path', 'D:\xampp\htdocs\jobportal\api\gmail\vendor\google\apiclient\src');
require_once ('api/gmail/vendor/autoload.php');
require_once 'Google/Client.php';
require_once 'Google/Service/Oauth2.php';


class Api_Login extends CI_Controller {

	public function __construct()
	{
	  	parent::__construct();
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
			$_SESSION['tw_status'] = true;
			if($connection->http_code=='200') {
				//redirect user to twitter
				$_SESSION['status'] = 'verified';
				$_SESSION['request_vars'] = $access_token;
				
				// unset no longer needed request tokens
				unset($_SESSION['token']);
				unset($_SESSION['token_secret']);
				redirect('home');
			}else{
				die("error, try again later!");
			}
		}else{
			die("error connecting to twitter! try again later!");
		}
	}

	public function gmail(){
		$client = new Google_Client();
		$client->setApplicationName("Job Portal");
		$client->setClientId(CLIENT_ID);
		$client->setClientSecret(CLIENT_SECRET);
		$client->setRedirectUri(REDIRECT_URI);
		$client->setDeveloperKey(SIMPLE_API_KEY);
		$client->addScope("https://www.googleapis.com/auth/userinfo.email");

		//Send Client Request
		$objOAuthService = new Google_Service_Oauth2($client);

		//Authenticate code from Google OAuth Flow
		//Add Access Token to Session
		if (isset($_GET['code'])) {
			die("hfffere");
		  $client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $client->getAccessToken();
		  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		} else {
			die("hello");
		}

		//Set Access Token to make Request
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			die("herhgfhe");
		  $client->setAccessToken($_SESSION['access_token']);
		}

		die("here");

	}

	public function gmail_call_back(){
		die("there");

	}

	public function fb_callback(){
		echo "hurray";die;
	}
}
