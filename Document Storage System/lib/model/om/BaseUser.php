<?php


abstract class BaseUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $student_id;


	
	protected $first_name = '';


	
	protected $last_name = '';


	
	protected $email;


	
	protected $password;


	
	protected $major;


	
	protected $level = 'bs';


	
	protected $phone;


	
	protected $credential = 'user';


	
	protected $note;


	
	protected $created_at;

	
	protected $collDocuments;

	
	protected $lastDocumentCriteria = null;

	
	protected $collShareds;

	
	protected $lastSharedCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getStudentId()
	{

		return $this->student_id;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getMajor()
	{

		return $this->major;
	}

	
	public function getLevel()
	{

		return $this->level;
	}

	
	public function getPhone()
	{

		return $this->phone;
	}

	
	public function getCredential()
	{

		return $this->credential;
	}

	
	public function getNote()
	{

		return $this->note;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserPeer::ID;
		}

	} 
	
	public function setStudentId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->student_id !== $v) {
			$this->student_id = $v;
			$this->modifiedColumns[] = UserPeer::STUDENT_ID;
		}

	} 
	
	public function setFirstName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v || $v === '') {
			$this->first_name = $v;
			$this->modifiedColumns[] = UserPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v || $v === '') {
			$this->last_name = $v;
			$this->modifiedColumns[] = UserPeer::LAST_NAME;
		}

	} 
	
	public function setEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

	} 
	
	public function setPassword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserPeer::PASSWORD;
		}

	} 
	
	public function setMajor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->major !== $v) {
			$this->major = $v;
			$this->modifiedColumns[] = UserPeer::MAJOR;
		}

	} 
	
	public function setLevel($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->level !== $v || $v === 'bs') {
			$this->level = $v;
			$this->modifiedColumns[] = UserPeer::LEVEL;
		}

	} 
	
	public function setPhone($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = UserPeer::PHONE;
		}

	} 
	
	public function setCredential($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credential !== $v || $v === 'user') {
			$this->credential = $v;
			$this->modifiedColumns[] = UserPeer::CREDENTIAL;
		}

	} 
	
	public function setNote($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = UserPeer::NOTE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = UserPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->student_id = $rs->getString($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->email = $rs->getString($startcol + 4);

			$this->password = $rs->getString($startcol + 5);

			$this->major = $rs->getString($startcol + 6);

			$this->level = $rs->getString($startcol + 7);

			$this->phone = $rs->getString($startcol + 8);

			$this->credential = $rs->getString($startcol + 9);

			$this->note = $rs->getString($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDocuments !== null) {
				foreach($this->collDocuments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collShareds !== null) {
				foreach($this->collShareds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDocuments !== null) {
					foreach($this->collDocuments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShareds !== null) {
					foreach($this->collShareds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getStudentId();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getEmail();
				break;
			case 5:
				return $this->getPassword();
				break;
			case 6:
				return $this->getMajor();
				break;
			case 7:
				return $this->getLevel();
				break;
			case 8:
				return $this->getPhone();
				break;
			case 9:
				return $this->getCredential();
				break;
			case 10:
				return $this->getNote();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getStudentId(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getLastName(),
			$keys[4] => $this->getEmail(),
			$keys[5] => $this->getPassword(),
			$keys[6] => $this->getMajor(),
			$keys[7] => $this->getLevel(),
			$keys[8] => $this->getPhone(),
			$keys[9] => $this->getCredential(),
			$keys[10] => $this->getNote(),
			$keys[11] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setStudentId($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setEmail($value);
				break;
			case 5:
				$this->setPassword($value);
				break;
			case 6:
				$this->setMajor($value);
				break;
			case 7:
				$this->setLevel($value);
				break;
			case 8:
				$this->setPhone($value);
				break;
			case 9:
				$this->setCredential($value);
				break;
			case 10:
				$this->setNote($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStudentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPassword($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMajor($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLevel($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPhone($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCredential($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNote($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::STUDENT_ID)) $criteria->add(UserPeer::STUDENT_ID, $this->student_id);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UserPeer::MAJOR)) $criteria->add(UserPeer::MAJOR, $this->major);
		if ($this->isColumnModified(UserPeer::LEVEL)) $criteria->add(UserPeer::LEVEL, $this->level);
		if ($this->isColumnModified(UserPeer::PHONE)) $criteria->add(UserPeer::PHONE, $this->phone);
		if ($this->isColumnModified(UserPeer::CREDENTIAL)) $criteria->add(UserPeer::CREDENTIAL, $this->credential);
		if ($this->isColumnModified(UserPeer::NOTE)) $criteria->add(UserPeer::NOTE, $this->note);
		if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStudentId($this->student_id);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setEmail($this->email);

		$copyObj->setPassword($this->password);

		$copyObj->setMajor($this->major);

		$copyObj->setLevel($this->level);

		$copyObj->setPhone($this->phone);

		$copyObj->setCredential($this->credential);

		$copyObj->setNote($this->note);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDocuments() as $relObj) {
				$copyObj->addDocument($relObj->copy($deepCopy));
			}

			foreach($this->getShareds() as $relObj) {
				$copyObj->addShared($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	
	public function initDocuments()
	{
		if ($this->collDocuments === null) {
			$this->collDocuments = array();
		}
	}

	
	public function getDocuments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocuments === null) {
			if ($this->isNew()) {
			   $this->collDocuments = array();
			} else {

				$criteria->add(DocumentPeer::USER_ID, $this->getId());

				DocumentPeer::addSelectColumns($criteria);
				$this->collDocuments = DocumentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DocumentPeer::USER_ID, $this->getId());

				DocumentPeer::addSelectColumns($criteria);
				if (!isset($this->lastDocumentCriteria) || !$this->lastDocumentCriteria->equals($criteria)) {
					$this->collDocuments = DocumentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDocumentCriteria = $criteria;
		return $this->collDocuments;
	}

	
	public function countDocuments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DocumentPeer::USER_ID, $this->getId());

		return DocumentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDocument(Document $l)
	{
		$this->collDocuments[] = $l;
		$l->setUser($this);
	}


	
	public function getDocumentsJoinType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDocuments === null) {
			if ($this->isNew()) {
				$this->collDocuments = array();
			} else {

				$criteria->add(DocumentPeer::USER_ID, $this->getId());

				$this->collDocuments = DocumentPeer::doSelectJoinType($criteria, $con);
			}
		} else {
									
			$criteria->add(DocumentPeer::USER_ID, $this->getId());

			if (!isset($this->lastDocumentCriteria) || !$this->lastDocumentCriteria->equals($criteria)) {
				$this->collDocuments = DocumentPeer::doSelectJoinType($criteria, $con);
			}
		}
		$this->lastDocumentCriteria = $criteria;

		return $this->collDocuments;
	}

	
	public function initShareds()
	{
		if ($this->collShareds === null) {
			$this->collShareds = array();
		}
	}

	
	public function getShareds($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSharedPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShareds === null) {
			if ($this->isNew()) {
			   $this->collShareds = array();
			} else {

				$criteria->add(SharedPeer::USER_ID, $this->getId());

				SharedPeer::addSelectColumns($criteria);
				$this->collShareds = SharedPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SharedPeer::USER_ID, $this->getId());

				SharedPeer::addSelectColumns($criteria);
				if (!isset($this->lastSharedCriteria) || !$this->lastSharedCriteria->equals($criteria)) {
					$this->collShareds = SharedPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSharedCriteria = $criteria;
		return $this->collShareds;
	}

	
	public function countShareds($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSharedPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SharedPeer::USER_ID, $this->getId());

		return SharedPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addShared(Shared $l)
	{
		$this->collShareds[] = $l;
		$l->setUser($this);
	}


	
	public function getSharedsJoinDocument($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSharedPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShareds === null) {
			if ($this->isNew()) {
				$this->collShareds = array();
			} else {

				$criteria->add(SharedPeer::USER_ID, $this->getId());

				$this->collShareds = SharedPeer::doSelectJoinDocument($criteria, $con);
			}
		} else {
									
			$criteria->add(SharedPeer::USER_ID, $this->getId());

			if (!isset($this->lastSharedCriteria) || !$this->lastSharedCriteria->equals($criteria)) {
				$this->collShareds = SharedPeer::doSelectJoinDocument($criteria, $con);
			}
		}
		$this->lastSharedCriteria = $criteria;

		return $this->collShareds;
	}

} 