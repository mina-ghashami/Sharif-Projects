<?php


abstract class BaseLimit extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $attr_id;


	
	protected $limitation;

	
	protected $aAttribute;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAttrId()
	{

		return $this->attr_id;
	}

	
	public function getLimitation()
	{

		return $this->limitation;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = LimitPeer::ID;
		}

	} 
	
	public function setAttrId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->attr_id !== $v) {
			$this->attr_id = $v;
			$this->modifiedColumns[] = LimitPeer::ATTR_ID;
		}

		if ($this->aAttribute !== null && $this->aAttribute->getId() !== $v) {
			$this->aAttribute = null;
		}

	} 
	
	public function setLimitation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->limitation !== $v) {
			$this->limitation = $v;
			$this->modifiedColumns[] = LimitPeer::LIMITATION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->attr_id = $rs->getInt($startcol + 1);

			$this->limitation = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Limit object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LimitPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LimitPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LimitPeer::DATABASE_NAME);
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


												
			if ($this->aAttribute !== null) {
				if ($this->aAttribute->isModified()) {
					$affectedRows += $this->aAttribute->save($con);
				}
				$this->setAttribute($this->aAttribute);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LimitPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += LimitPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aAttribute !== null) {
				if (!$this->aAttribute->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAttribute->getValidationFailures());
				}
			}


			if (($retval = LimitPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LimitPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAttrId();
				break;
			case 2:
				return $this->getLimitation();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LimitPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAttrId(),
			$keys[2] => $this->getLimitation(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LimitPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAttrId($value);
				break;
			case 2:
				$this->setLimitation($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LimitPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAttrId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLimitation($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LimitPeer::DATABASE_NAME);

		if ($this->isColumnModified(LimitPeer::ID)) $criteria->add(LimitPeer::ID, $this->id);
		if ($this->isColumnModified(LimitPeer::ATTR_ID)) $criteria->add(LimitPeer::ATTR_ID, $this->attr_id);
		if ($this->isColumnModified(LimitPeer::LIMITATION)) $criteria->add(LimitPeer::LIMITATION, $this->limitation);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LimitPeer::DATABASE_NAME);

		$criteria->add(LimitPeer::ID, $this->id);

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

		$copyObj->setAttrId($this->attr_id);

		$copyObj->setLimitation($this->limitation);


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
			self::$peer = new LimitPeer();
		}
		return self::$peer;
	}

	
	public function setAttribute($v)
	{


		if ($v === null) {
			$this->setAttrId(NULL);
		} else {
			$this->setAttrId($v->getId());
		}


		$this->aAttribute = $v;
	}


	
	public function getAttribute($con = null)
	{
		if ($this->aAttribute === null && ($this->attr_id !== null)) {
						include_once 'lib/model/om/BaseAttributePeer.php';

			$this->aAttribute = AttributePeer::retrieveByPK($this->attr_id, $con);

			
		}
		return $this->aAttribute;
	}

} 