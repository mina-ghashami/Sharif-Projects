<?php

class myUser extends sfBasicSecurityUser
{

  public function getObject(){
  	$request = $this->getContext()->getRequest();
  	$obj = $request->getAttribute('user', null, 'subscriber');
  	if ($obj) return $obj;
  	
  	$obj = UsersPeer::retrieveByPK($this->getId());
  	$request->setAttribute('user', $obj);
  	return $obj;
  	
  	
  	
  	
  	
  }
  public function getId(){
    return  $this->getAttribute('id',NULL, 'subscriber');
  }

  public function getTitle(){
    return  $this->getAttribute('title',NULL, 'subscriber');
  }


  public function signIn($user)
  {
    $this->setAttribute('id', $user->getId(), 'subscriber');
    $this->setAttribute('title', $user->getFirstName(), 'subscriber');
    $this->setAuthenticated(true);
    $this->addCredential('subscriber');
    $creds = explode(",", $user->getCredential());
    foreach ($creds as $cred)
    if ($cred != ''){
      $this->addCredential($cred);
    }
  }

  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace('subscriber');
    $this->setAuthenticated(false);
    $this->clearCredentials();
  }


}
