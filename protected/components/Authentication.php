 <?php

	require dirname(__FILE__).'/../../vendor/php-sdk/facebook.php';
	class Authentication extends CComponent {
        private $facebook;

        function __construct() {
            $this->facebook = new Facebook(Yii::app()->params['FB']);
        }

        public function authenticate() {
            $uid = $this->facebook -> getUser();
			echo $uid;
			$me = FALSE;
            $access_token = $this->facebook->getAccessToken();
			echo $access_token;
            if ($uid) {
                try {
                    $me = $this->facebook -> api('/me?access_token='.$access_token);
                } catch (FacebookApiException $e) {
                    error_log($e);
                }
            }
            if ($me) {
                $logoutUrl = $this->facebook -> getLogoutUrl();
                $status = array(
                    'loggedIn'=>TRUE,
                    'logoutUrl'=>$logoutUrl,
                    'me'=>$me,
                    'access_token' => $access_token
                );
            } else {
                $loginUrl = $this->facebook -> getLoginUrl(Yii::app()->params['FB_params']);
                $status = array(
                    'loggedIn'=>FALSE,
                    'loginUrl'=>$loginUrl,
                );
            }
            return $status;
        }

        public function getMe() {
            $access_token = $this->facebook->getAccessToken();
            $me = $this->facebook -> api('/me?access_token='.$access_token);
            return $me;
        }

        public function getFbPageLikes($pageId) {
            return $this->facebook->api('/me/likes/'.$pageId);
        }

        public function doAutoPost($args) {
            $result = $facebook->api("me/feed","POST",$args);
            $postid1 = '';
            foreach ($result as $key => $value) {
                $postid1=$value;
            }
            return "<br>Photo post id = ".$postid1;
        }
		
        public function getFbRef(){
            return $this->facebook;
        }
		
		public function parsePageSignedRequest() {
	    if (isset($_REQUEST['signed_request'])) {
	      $encoded_sig = null;
	      $payload = null;
	      list($encoded_sig, $payload) = explode('.', $_REQUEST['signed_request'], 2);
	      $sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
	      $data = json_decode(base64_decode(strtr($payload, '-_', '+/'), true));
	      return $data;
	    }
	    return false;
	  }
		
		public function pageLiked(){
			$signed_request = $this->facebook->getSignedRequest();
			if($signed_request = $this->parsePageSignedRequest()) {
		   		if($signed_request->page->liked) {
		   			return true;
				}else{
					return false;
				}
			}
		}
		
    }
?>