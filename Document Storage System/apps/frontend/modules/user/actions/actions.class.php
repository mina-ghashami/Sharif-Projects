<?php


class userActions extends autouserActions
{
  public function executeView(){
		
		$uid = $this->getRequestParameter('id');
//		
//		$user = UserPeer::retrieveByPK($id);
//		$name = $user->getFirstName();
//		$name = $name ." ". $user->getLastName();
//		$this->name = $name;
//		$c = new Criteria();
//		$c->add(DocumentPeer::USER_ID , $id);
//		$c->addAscendingOrderByColumn( DocumentPeer::CREATED_AT );
//		$docs = DocumentPeer::doSelect($c);
//		
//		$inarr;
//		$outarr = array();
//		foreach ($docs as $doc){
//			$inarr["name"] = $doc->getName();
//			$typeId = $doc->getTypeId();
//			$doc = DocTypePeer::retrieveByPK($typeId);
//			$inarr["type"] =  $doc->getType();
//			$outarr[] = $inarr;
//		}
//		
//		$this->outarr = $outarr;
		$this -> user = UserPeer::retrieveByPK($uid);
		
		$c = new Criteria();
		$c -> add(DocumentPeer::USER_ID, $uid, Criteria::EQUAL);
		$this -> docs = DocumentPeer::doSelect($c);
		
		$c = new Criteria();
		$c -> add(SharedPeer::USER_ID,$uid,Criteria::EQUAL);
		
		$shareds = SharedPeer::doSelect($c);
		$pks = $this -> getPKs($shareds);
		
		$this ->shareds = DocumentPeer::retrieveByPKs($pks);
		
	}

  	public function getPKs($shareds){
	  	$tarr = array();
	  	foreach ($shareds as $shared){
	  		
	  		$tarr[] = $shared -> getDocId();
	  	}
	  	return $tarr;	
  	}
  	
  public function executeIndex()
  {
    //return $this->forward('user', 'list');
  }
	
  public function executeProfile(){
		$id = $this->getRequestParameter('id');
		$user = UserPeer::retrieveByPK($id);
		$this->redirect('service/profile?uid='.$id);
	}
	
  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/user/filters');

    // pager
    $this->pager = new sfPropelPager('User', 10);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/user')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/user');
    }
  }
 
  public function executeCreate()
  {
    return $this->forward('user', 'edit');
  }

  public function executeSave()
  {
  	//$this->getRequestParameter('email');
    return $this->forward('user', 'edit');
  }
  
  public function executeEdit()
  {
    $this->user = $this->getUserOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateUserFromRequest();

      $this->saveUser($this->user);

      $this->setFlash('notice', 'تغییرات شما ذخیره شد ');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('user/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('user/list');
      }
      else
      {
        return $this->redirect('user/edit?id='.$this->user->getId());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->user = UserPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->user);

    try
    {
      $this->deleteUser($this->user);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected User. Make sure it does not have any associated items.');
      return $this->forward('user', 'list');
    }

    return $this->redirect('user/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->user = $this->getUserOrCreate();
    $this->updateUserFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveUser($user)
  {
    $user->save();

  }

  protected function deleteUser($user)
  {
    $user->delete();
  }

  protected function updateUserFromRequest()
  {
    $user = $this->getRequestParameter('user');

    if (isset($user['student_id']))
    {
      $this->user->setStudentId($user['student_id']);
    }
    if (isset($user['first_name']))
    {
      $this->user->setFirstName($user['first_name']);
    }
    if (isset($user['last_name']))
    {
      $this->user->setLastName($user['last_name']);
    }
    if (isset($user['email']))
    {
    	//echo "this is email : ".$user['email'];
      $this->user->setEmail($user['email']);
      
    }
    if (isset($user['password']))
    {
      $this->user->setPassword($user['password']);
    }
    if (isset($user['major']))
    {
      $this->user->setMajor($user['major']);
    }
    if (isset($user['level']))
    {
      $this->user->setLevel($user['level']);
    }
    if (isset($user['phone']))
    {
      $this->user->setPhone($user['phone']);
    }
    if (isset($user['credential']))
    {
      $this->user->setCredential($user['credential']);
    }
    if (isset($user['note']))
    {
      $this->user->setNote($user['note']);
    }
    if (isset($user['created_at']))
    {
      if ($user['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($user['created_at']))
          {
            $value = $dateFormat->format($user['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $user['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->user->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->user->setCreatedAt(null);
      }
    }
  }

  protected function getUserOrCreate($id = 'id')
  {
    if (!$this->getRequestParameter($id))
    {
      $user = new User();
    }
    else
    {
      $user = UserPeer::retrieveByPk($this->getRequestParameter($id));

      $this->forward404Unless($user);
    }

    return $user;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/user');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/user/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/user/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/user/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/user/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/user/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['email_is_empty']))
    {
      $criterion = $c->getNewCriterion(UserPeer::EMAIL, '');
      $criterion->addOr($c->getNewCriterion(UserPeer::EMAIL, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['email']) && $this->filters['email'] !== '')
    {
      $c->add(UserPeer::EMAIL, strtr($this->filters['email'], '*', '%'), Criteria::LIKE);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/user/sort'))
    {
      $sort_column = UserPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/user/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'user{id}' => 'Id:',
      'user{student_id}' => 'Student:',
      'user{first_name}' => 'First name:',
      'user{last_name}' => 'Last name:',
      'user{email}' => 'Email:',
      'user{password}' => 'Password:',
      'user{major}' => 'Major:',
      'user{level}' => 'Level:',
      'user{phone}' => 'Phone:',
      'user{credential}' => 'Credential:',
      'user{note}' => 'Note:',
      'user{created_at}' => 'Created at:',
    );
  }
	
	
}
