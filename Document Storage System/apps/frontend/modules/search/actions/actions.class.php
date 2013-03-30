<?php

/**
 * search actions.
 *
 * @package    new
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class searchActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('search', 'user');

  }
  
  public function executeUser()
  {
  	$uSession = $this -> getUser();
  	
  	if(!$uSession -> isAuthenticated()){
  		$this->redirect('service/index');
  	}
  	if($uSession->hasCredential('admin') || $uSession->hasCredential('designer'))
  		$visible = true;
  	else
  		$visible = false;
  	$this->visible = $visible;

  	$this->uid = $uSession->getAttribute('uid');
  		
  }
  
  public function executeAddElem()
  {
    $uSession = $this -> getUser();
  	
  	if(!$uSession -> isAuthenticated()){
  		$this->redirect('service/index');
  	}
  	
  	$this->case = $this->getRequestParameter('case');
  	if($this->case == 'first_name')
  		$this->name = 'نام';
  	else if($this->case == 'last_name')
		$this->name = 'نام خانوادگی';
  	else if($this->case == 'email')
  		$this->name = 'پست الکترونیکی';
  	else if($this->case == 'major')
  		$this->name = 'رشته تحصیلی';
  	else if($this->case == 'level')
  		$this->name = 'مقطع تحصیلی';
  	else {
  		$this->redirect('search/user');	
  	}
  	
  }
  
  public function executeShow(){
  	
    $uSession = $this -> getUser();
    $this->uid = $uSession->getAttribute('uid');
  	
  	if(!$uSession -> isAuthenticated()){
  		$this->redirect('service/index');
  	}
  	if($uSession->hasCredential('admin') || $uSession->hasCredential('designer'))
  		$visible = true;
  	else
  		$visible = false;
  	$this->visible = $visible;	
  	
  	if($this->getRequest()->getMethod() == sfRequest::GET)
  		$this->redirect('search/user');
  		
  	$res = array();
  	
  	$fname = $this->getRequestParameter('first_name_input');
  	$fradio = $this->getRequestParameter('first_name_radio');
  	
  	$lname = $this->getRequestParameter('last_name_input');
  	$lradio = $this->getRequestParameter('last_name_radio');
  	
  	$email = $this->getRequestParameter('email_input');
  	$emailRadio = $this->getRequestParameter('email_radio');
  	
  	$major = $this->getRequestParameter('major_input');
  	$majorRadio = $this->getRequestParameter('major_radio');
  	
  	$level = $this->getRequestParameter('level_input');
  	$levelRadio = $this->getRequestParameter('level_radio');
  	
  	$c = new Criteria();
  	if($fname != ''){
  		if($fradio == 'wholeWord')
  			$c->add(UserPeer::FIRST_NAME , $fname);
  		else{
  			$c->add(UserPeer::FIRST_NAME , '%'.$fname.'%' , Criteria::LIKE );
  			//echo "shamel";
  		}	
  	}
  	if($lname != ''){
  		if($lradio == 'wholeWord')
  			$c->add(UserPeer::LAST_NAME , $lname);
  		else{
  			$c->add(UserPeer::LAST_NAME , '%'.$lname.'%' , Criteria::LIKE );
  			
  		}	
  	}	
  	if($email != ''){
  		if($emailRadio == 'wholeWord')
  			$c->add(UserPeer::EMAIL , $email);
  		else
  			$c->add(UserPeer::EMAIL , '%'.$email.'%' , Criteria::LIKE );	
  	}
    if($major != ''){
  		if($majorRadio == 'wholeWord')
  			$c->add(UserPeer::MAJOR , $major);
  		else
  			$c->add(UserPeer::MAJOR , '%'.$major.'%' , Criteria::LIKE );	
  	}	
  	if($level != ''){
  		if($levelRadio == 'wholeWord')
  			$c->add(UserPeer::LEVEL , $level);
  		else
  			$c->add(UserPeer::LEVEL , '%'.$level.'%' , Criteria::LIKE );	
  	}	
  	
  	$res = UserPeer::doSelect($c);
  	$this->res = $res;
  	
  	$this->size = sizeof($res);
//  	$this->fname = array();
//  	$this->lname = array();
//  	$this->email = array();
//  	$this->major = array();
//  	$this->level = array();
//  	
//  	foreach ($res as $r){
//  		$this->fname[] = $r->getFirstName();
//  		$this->lname[] = $r->getLastName();
//  		$this->email[] = $r->getEmail();
//  		$this->major[] = $r->getMajor();
//  		$this->level[] = $r->getLevel();
//  	}
  	
  	
	
  }
}
