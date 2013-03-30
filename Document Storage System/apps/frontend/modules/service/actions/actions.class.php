<?php

class serviceActions extends sfActions
{
  public function executeIndex(){
  	
  }
  public function executeAbout(){
  	
  }
  public function executeLogin(){
  	
  	$uSession = $this -> getUser();
  	
  	if( ! $uSession -> isAuthenticated() ){
  		
  		$username = $this->getRequestParameter('username');
	  	$psw = $this->getRequestParameter('password');
	  	
	  	
		if( ($username == NULL || $psw == NULL)  ){  	
	  		$this -> redirect('service/index');
		}
		
	  	$c = new Criteria();
	  	$c -> add(UserPeer::EMAIL,$username,Criteria::EQUAL);
	  	$c -> add(UserPeer::PASSWORD,$psw , Criteria::EQUAL);
	  	
	  	$user = UserPeer::doSelectOne($c);
	  	
	  	if( !$user){
	  	
	  		$this -> getRequest()->setError('nouser','کاربری با این مشخصات وجود ندارد. لطفا اطلاعات خود را مجددا درست وارد نمایید');
	  		$this -> forward('service','index');
	  	}
	  	$this -> uid = $user -> getId();
	  	
	  	$uSession = $this->getUser(); // user session 
	    $uSession -> setAuthenticated(true);  	  
	  	$uSession -> setAttribute('uid', $this -> uid);
	  	// $uSession ->setAttribute('isLoginned',true);
	  	$this->setCredential($user);
  	}else {
  		$uSession = $this->getUser();
  		$this -> uid = $uSession->getAttribute('uid');
  		
  	}
  	
  }
  
  public function handleErrorLogin(){
  	$this -> forward('service','index');
  }
  public function executeForgetpass(){
    
  	$c = new Captcha();
    $im = $c -> createCaptcha();
    $this -> captchaVal = $c -> string; 
    
    if($im != NULL)
    	imagepng($im,"images/captcha.jpg");
    else 
    	echo "image is null";
	$this -> image = "captcha.jpg";   
	//$this -> getUser() -> addCredential('forget'); 	
  }
  public function executeMail(){
  	
//  	if( ! $this->getUser()->hasCredential('forget') ){
//  		
//  		$this -> forward('service','index'); 
//  	}
  	
  	$this -> getUser()-> removeCredential('forget');
  	
  	$captcha = $this->getRequestParameter('captcha');
  	$email = $this->getRequestParameter('email');
  	$value =  $this->getRequestParameter('value');
  	
  	$c = new Criteria();
  	$c ->add(UserPeer::EMAIL,$email,Criteria::EQUAL);
  	$user = UserPeer::doSelectOne($c);
  	
  	if($user == NULL){
		$this->getRequest()->setError('email',"پست الکترونیکی خود را اشتباه وارد کرده اید.");
  		$this -> forward('service','forgetpass');
  	}else if($value != $captcha){
  		$this->getRequest()->setError('captcha',"کلمه وارد شده نادرست است.");
  		//$this -> redirect('service/forgetpass');
  		$this -> forward('service','forgetpass');
  	}else {
  		
  		$mail = new Mail();//for test
  		$mail -> SendEmail("m.liaee2050@gmail.com","m.liaee2050@gmail.com","","","salam","this is a new test",false);
  		// $this -> msg = "میل خود را چک کنید. رمزتان به شما میل زده شد.";
  		$this->getRequest()->setError('sent',"میل خود را چک کنید. رمزتان به شما میل زده شد.");
  		$this->forward('service','index');
  	}
  }
  public function executeLogout(){
  	$uSession = $this -> getUser(); 
  	$uSession -> setAuthenticated(false);
  	$uSession -> clearCredentials();
  	$this->redirect('service/index');
  	
  }
  public function executeProfile(){
  	
  	$uSession = $this -> getUser();
  	if( !$uSession->isAuthenticated() )
  		$this -> redirect('service/index');

  	$uid = $this ->getRequestParameter('uid');
  	$uid2 = $uSession->getAttribute('uid');
  	$this->canEdit = false; 
  	if($uid == $uid2)
  			$this->canEdit = true;
  			
	$this -> user = UserPeer::retrieveByPK($uid);
	  		
  }
  
  public function executeEditProfile(){
  	
  	$uSession = $this -> getUser();
  	if($uSession->isAuthenticated())
  	{
	  	$uid = $uSession -> getAttribute('uid');
	  	$user = UserPeer::retrieveByPK($uid);
	  	
	  	$attr = $this->request->getParameter('attribute');
	  	$val = $this->request->getParameter('value');
	  	
	  	if($attr == 'Level'){
	  		
	  		if(strcasecmp($val,'bs')!= 0 && strcasecmp($val,'ms')!= 0 && strcasecmp($val,'phd')!= 0){//illegal input
	  			echo $user ->getLevel();		
	  		}else {
	  			
			  	$set_func = 'set'.$attr;
			  	$val = trim($val);
			  	$user->$set_func($val);
			   	$user->save();
			   	echo $this->request->getParameter('value');
	  		}
	  	}
	  	else if($attr == 'Password'){
	  		if(strlen($val)<6 || strlen($val)>256 ){
	  			echo $user->getPassword();
	  		}
	  		else{
	  			$set_func = 'set'.$attr;
	  			$val = trim($val);
			  	$user->$set_func($val);
			   	$user->save();
			   	echo $this->request->getParameter('value');
	  		}
	  	}
	  	else{ 
	  		$set_func = 'set'.$attr;
	  		$val = trim($val);
	  		if($val == '' || $val == ' ')
	  			$val = '&nbsp;';
		  	$user->$set_func($val);
		   	$user->save();	
		  	echo $val;
	  		
	  	}
  	}
	
  	
  	
  }
 
  
  public function setCredential($user){
  	$cred = $user -> getCredential();
  	$uSession = $this -> getUser();
  	 
  	if($cred == "user"){
  		$uSession -> addCredential('user');
  	}else if($cred == "admin"){
  		$uSession -> addCredentials('user','admin');
  	}else if($cred == "designer"){
  		$uSession -> addCredentials('user','admin','designer');
   	}else {
  	}
  	
  }
}
