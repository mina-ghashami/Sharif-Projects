<?php


abstract class BaseDocument extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type_id;


	
	protected $user_id;


	
	protected $path;


	
	protected $created_at;

	
	protected $aType;

	
	protected $aUser;

	
	protected $collShareds;

	
	protected $lastSharedCriteria = null;

	
	protected $collValues;

	
	protected $lastValueCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTypeId()
	{

		return $this->type_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getPath()
	{

		return $this->path;
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
			$this->modifiedColumns[] = DocumentPeer::ID;
		}

	} 
	
	public function setTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type_id !== $v) {
			$this->type_id = $v;
			$this->modifiedColumns[] = DocumentPeer::TYPE_ID;
		}

		if ($this->aType !== null && $this->aType->getId() !== $v) {
			$this->aType = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = DocumentPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setPath($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->path !== $v) {
			$this->path = $v;
			$this->modifiedColumns[] = DocumentPeer::PATH;
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
			$this->modifiedColumns[] = DocumentPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type_id = $rs->getInt($startcol + 1);

			$this->user_id = $rs->getInt($startcol + 2);

			$this->path = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Document object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DocumentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DocumentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DocumentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DocumentPeer::DATABASE_NAME);
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


												
			if ($this->aType !== null) {
				if ($this->aType->isModified()) {
					$affectedRows += $this->aType->save($con);
				}
				$this->setType($this->aType);
			}

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DocumentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DocumentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collShareds !== null) {
				foreach($this->collShareds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collValues !== null) {
				foreach($this->collValues as $referrerFK) {
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


												
			if ($this->aType !== null) {
				if (!$this->aType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aType->getValidationFailures());
				}
			}

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = DocumentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collShareds !== null) {
					foreach($this->collShareds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collValues !== null) {
					foreach($this->collValues as $referrerFK) {
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
		$pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTypeId();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getPath();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DocumentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTypeId(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getPath(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DocumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTypeId($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setPath($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DocumentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPath($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DocumentPeer::DATABASE_NAME);

		if ($this->isColumnModified(DocumentPeer::ID)) $criteria->add(DocumentPeer::ID, $this->id);
		if ($this->isColumnModified(DocumentPeer::TYPE_ID)) $criteria->add(DocumentPeer::TYPE_ID, $this->type_id);
		if ($this->isColumnModified(DocumentPeer::USER_ID)) $criteria->add(DocumentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(DocumentPeer::PATH)) $criteria->add(DocumentPeer::PATH, $this->path);
		if ($this->isColumnModified(DocumentPeer::CREATED_AT)) $criteria->add(DocumentPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DocumentPeer::DATABASE_NAME);

		$criteria->add(DocumentPeer::ID, $this->id);

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

		$copyObj->setTypeId($this->type_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setPath($this->path);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getShareds() as $relObj) {
				$copyObj->addShared($relObj->copy($deepCopy));
			}

			foreach($this->getValues() as $relObj) {
				$copyObj->addValue($relObj->copy($deepCopy));
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
			self::$peer = new DocumentPeer();
		}
		return self::$peer;
	}

	
	public function setType($v)
	{


		if ($v === null) {
			$this->setTypeId(NULL);
		} else {
			$this->setTypeId($v->getId());
		}


		$this->aType = $v;
	}


	
	public function getType($con = null)
	{
		if ($this->aType === null && ($this->type_id !== null)) {
						include_once 'lib/model/om/BaseTypePeer.php';

			$this->aType = TypePeer::retrieveByPK($this->type_id, $con);

			
		}
		return $this->aType;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
		if ($this->aUser === null && ($this->user_id !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aUser;
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

				$criteria->add(SharedPeer::DOC_ID, $this->getId());

				SharedPeer::addSelectColumns($criteria);
				$this->collShareds = SharedPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SharedPeer::DOC_ID, $this->getId());

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

		$criteria->add(SharedPeer::DOC_ID, $this->getId());

		return SharedPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addShared(Shared $l)
	{
		$this->collShareds[] = $l;
		$l->setDocument($this);
	}


	
	public function getSharedsJoinUser($criteria = null, $con = null)
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

				$criteria->add(SharedPeer::DOC_ID, $this->getId());

				$this->collShareds = SharedPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(SharedPeer::DOC_ID, $this->getId());

			if (!isset($this->lastSharedCriteria) || !$this->lastSharedCriteria->equals($criteria)) {
				$this->collShareds = SharedPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastSharedCriteria = $criteria;

		return $this->collShareds;
	}

	
	public function initValues()
	{
		if ($this->collValues === null) {
			$this->collValues = array();
		}
	}

	
	public function getValues($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseValuePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collValues === null) {
			if ($this->isNew()) {
			   $this->collValues = array();
			} else {

				$criteria->add(ValuePeer::DOC_ID, $this->getId());

				ValuePeer::addSelectColumns($criteria);
				$this->collValues = ValuePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ValuePeer::DOC_ID, $this->getId());

				ValuePeer::addSelectColumns($criteria);
				if (!isset($this->lastValueCriteria) || !$this->lastValueCriteria->equals($criteria)) {
					$this->collValues = ValuePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastValueCriteria = $criteria;
		return $this->collValues;
	}

	
	public function countValues($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseValuePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ValuePeer::DOC_ID, $this->getId());

		return ValuePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addValue(Value $l)
	{
		$this->collValues[] = $l;
		$l->setDocument($this);
	}


	
	public function getValuesJoinAttribute($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseValuePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collValues === null) {
			if ($this->isNew()) {
				$this->collValues = array();
			} else {

				$criteria->add(ValuePeer::DOC_ID, $this->getId());

				$this->collValues = ValuePeer::doSelectJoinAttribute($criteria, $con);
			}
		} else {
									
			$criteria->add(ValuePeer::DOC_ID, $this->getId());

			if (!isset($this->lastValueCriteria) || !$this->lastValueCriteria->equals($criteria)) {
				$this->collValues = ValuePeer::doSelectJoinAttribute($criteria, $con);
			}
		}
		$this->lastValueCriteria = $criteria;

		return $this->collValues;
	}

} 