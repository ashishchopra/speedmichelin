<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionPageTab()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$auth = new Authentication();
		//$page_liked = $auth->pageLiked();
		$status = $auth->authenticate();
		if($status['loggedIn']){
			//save user facebook info in cookies
		    $this->saveCookie($status);
			//Save User Information in the table
			$this->saveUser($status);
			//send user to the landing page of the app
			$this->render('main');
		}else{
			echo "not logged in";
			//$this->render('upload');
			$this->renderPartial('auth',array('url'=>$status['loginUrl']));
		}
	}
	
	public function actionUpload() {
		/*	
		$img_path = Yii::app()->request->baseUrl . "/images/";
		$cmd = "convert " . $img_path . "koala.gif " . $img_path . "blur_map_polar.jpg  -compose blur -define compose:args=10x0+0+180 -composite " . $img_path . "blur_weird.jpg";
		echo $cmd;
		$res = exec($cmd);
		echo $res;*/
		$this->render('upload');
	}

	public function actionCanvasUrl() {
		$this->render('index');
	}
	
	public function actionAdd() {
		$this->render('add');
	}


	public function saveCookie($status){
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
	    Yii::app()->request->cookies['status'] = new CHttpCookie('status', $status['loggedIn']);
		Yii::app()->request->cookies['uid'] = new CHttpCookie('uid', $status['me']['id']);
		Yii::app()->request->cookies['name'] = new CHttpCookie('name', $status['me']['name']);
		Yii::app()->request->cookies['email'] = new CHttpCookie('email', $status['me']['email']);
	}

	public function saveUser($status) {
		$criteria=new CDbCriteria;
        $criteria->condition='uid=:uid';
        $criteria->params=array(':uid'=>$status['me']['id']);
        $id=Userinfo::model()->find($criteria);
        if($id === null) {
            $user = new Userinfo();
            $user->uid = $status['me']['id'];
            if(isset($status['me']['username'])){
                $user->username= $status['me']['username'];
            }
            $user->uname = $status['me']['name'];
            if (isset($status['me']['email'])){
                $user->uemail = $status['me']['email'];
            }
            $user->create_time = time();
            if($user->save()){
            	return true;
            }else{
            	return false;
            }
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionGallery() {
		$criteria = new CDbCriteria;
		$criteria->order = "create_time desc";
		$app_entries = AppEntry::model()->findAll($criteria);
		$this->render('gallery',  array('app_entries' => $app_entries));
	}
	
	public function actionLeaderboard() {
		$criteria = new CDbCriteria;
		$criteria->order = "points desc";
		$criteria->limit = 3;
		$lb_data = AppEntry::model()->findAll($criteria);
		$this->render('leaderboard', array('lb_data' => $lb_data));
	}

	public function selectMorphedImages() {
		$base_img = $_POST['img_src'];
	}
}