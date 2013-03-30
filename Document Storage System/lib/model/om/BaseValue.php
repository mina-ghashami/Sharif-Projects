<?php


abstract class BaseValue extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $doc_id;


	
	protected $attr_id;


	
	protected $val;


	
	protected $id;

	
	protected $aDocument;

	
	protected $aAttribute;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getDocId()
	{

		return $this->doc_id;
	}

	
	public function getAttrId()
	{

		return $this->attr_id;
	}

	
	public function getVal()
	{

		return $this->val;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setDocId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->doc_id !== $v) {
			$this->doc_id = $v;
			$this->modifiedColumns[] = ValuePeer::DOC_ID;
		}

		if ($this->aDocument !== null && $this->aDocument->getId() !== $v) {
			$this->aDocument = null;
		}

	} 
	
	public function setAttrId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->attr_id !== $v) {
			$this->attr_id = $v;
			$this->modifiedColumns[] = ValuePeer::ATTR_ID;
		}

		if ($this->aAttribute !== null && $this->aAttribute->getId() !== $v) {
			$this->aAttribute = null;
		}

	} 
	
	public function setVal($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->val !== $v) {
			$this->val = $v;
			$this->modifiedColumns[] = ValuePeer::VAL;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ValuePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->doc_id = $rs->getInt($startcol + 0);

			$this->attr_id = $rs->getInt($startcol + 1);

			$this->val = $rs->getString($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Value object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ValuePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ValuePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ValuePeer::DATABASE_NAME);
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


												
			if ($this->aDocument !== null) {
				if ($this->aDocument->isModified()) {
					$affectedRows += $this->aDocument->save($con);
				}
				$this->setDocument($this->aDocument);
			}

			if ($this->aAttribute !== null) {
				if ($this->aAttribute->isModified()) {
					$affectedRows += $this->aAttribute->save($con);
				}
				$this->setAttribute($this->aAttribute);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ValuePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ValuePeer::doUpdate($this, $con);
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


												
			if ($this->aDocument !== null) {
				if (!$this->aDocument->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDocument->getValidationFailures());
				}
			}

			if ($this->aAttribute !== null) {
				if (!$this->aAttribute->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAttribute->getValidationFailures());
				}
			}


			if (($retval = ValuePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ValuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getDocId();
				break;
			case 1:
				return $this->getAttrId();
				break;
			case 2:
				return $this->getVal();
				break;
			case 3:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ValuePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getDocId(),
			$keys[1] => $this->getAttrId(),
			$keys[2] => $this->getVal(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ValuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setDocId($value);
				break;
			case 1:
				$this->setAttrId($value);
				break;
			case 2:
				$this->setVal($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ValuePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDocId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAttrId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setVal($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ValuePeer::DATABASE_NAME);

		if ($this->isColumnModified(ValuePeer::DOC_ID)) $criteria->add(ValuePeer::DOC_ID, $this->doc_id);
		if ($this->isColumnModified(ValuePeer::ATTR_ID)) $criteria->add(ValuePeer::ATTR_ID, $this->attr_id);
		if ($this->isColumnModified(ValuePeer::VAL)) $criteria->add(ValuePeer::VAL, $this->val);
		if ($this->isColumnModified(ValuePeer::ID)) $criteria->add(ValuePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ValuePeer::DATABASE_NAME);

		$criteria->add(ValuePeer::ID, $this->id);

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

		$copyObj->setDocId($this->doc_id);

		$copyObj->setAttrId($this->attr_id);

		$copyObj->setVal($this->val);


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
			self::$peer = new ValuePeer();
		}
		return self::$peer;
	}

	
	public function setDocument($v)
	{


		if ($v === null) {
			$this->setDocId(NULL);
		} else {
			$this->setDocId($v->getId());
		}


		$this->aDocument = $v;
	}


	
	public function getDocument($con = null)
	{
		if ($this->aDocument === null && ($this->doc_id !== null)) {
						include_once 'lib/model/om/BaseDocumentPeer.php';

			$this->aDocument = DocumentPeer::retrieveByPK($this->doc_id, $con);

			
		}
		return $this->aDocument;
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