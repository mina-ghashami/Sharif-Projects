<?php


abstract class BaseType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;

	
	protected $collDocuments;

	
	protected $lastDocumentCriteria = null;

	
	protected $collAttributes;

	
	protected $lastAttributeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TypePeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = TypePeer::NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Type object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TypePeer::DATABASE_NAME);
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
					$pk = TypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDocuments !== null) {
				foreach($this->collDocuments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAttributes !== null) {
				foreach($this->collAttributes as $referrerFK) {
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


			if (($retval = TypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDocuments !== null) {
					foreach($this->collDocuments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAttributes !== null) {
					foreach($this->collAttributes as $referrerFK) {
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
		$pos = TypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TypePeer::DATABASE_NAME);

		if ($this->isColumnModified(TypePeer::ID)) $criteria->add(TypePeer::ID, $this->id);
		if ($this->isColumnModified(TypePeer::NAME)) $criteria->add(TypePeer::NAME, $this->name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TypePeer::DATABASE_NAME);

		$criteria->add(TypePeer::ID, $this->id);

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

		$copyObj->setName($this->name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDocuments() as $relObj) {
				$copyObj->addDocument($relObj->copy($deepCopy));
			}

			foreach($this->getAttributes() as $relObj) {
				$copyObj->addAttribute($relObj->copy($deepCopy));
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
			self::$peer = new TypePeer();
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

				$criteria->add(DocumentPeer::TYPE_ID, $this->getId());

				DocumentPeer::addSelectColumns($criteria);
				$this->collDocuments = DocumentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DocumentPeer::TYPE_ID, $this->getId());

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

		$criteria->add(DocumentPeer::TYPE_ID, $this->getId());

		return DocumentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDocument(Document $l)
	{
		$this->collDocuments[] = $l;
		$l->setType($this);
	}


	
	public function getDocumentsJoinUser($criteria = null, $con = null)
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

				$criteria->add(DocumentPeer::TYPE_ID, $this->getId());

				$this->collDocuments = DocumentPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(DocumentPeer::TYPE_ID, $this->getId());

			if (!isset($this->lastDocumentCriteria) || !$this->lastDocumentCriteria->equals($criteria)) {
				$this->collDocuments = DocumentPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastDocumentCriteria = $criteria;

		return $this->collDocuments;
	}

	
	public function initAttributes()
	{
		if ($this->collAttributes === null) {
			$this->collAttributes = array();
		}
	}

	
	public function getAttributes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAttributePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAttributes === null) {
			if ($this->isNew()) {
			   $this->collAttributes = array();
			} else {

				$criteria->add(AttributePeer::TYPE_ID, $this->getId());

				AttributePeer::addSelectColumns($criteria);
				$this->collAttributes = AttributePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AttributePeer::TYPE_ID, $this->getId());

				AttributePeer::addSelectColumns($criteria);
				if (!isset($this->lastAttributeCriteria) || !$this->lastAttributeCriteria->equals($criteria)) {
					$this->collAttributes = AttributePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAttributeCriteria = $criteria;
		return $this->collAttributes;
	}

	
	public function countAttributes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAttributePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AttributePeer::TYPE_ID, $this->getId());

		return AttributePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAttribute(Attribute $l)
	{
		$this->collAttributes[] = $l;
		$l->setType($this);
	}

} 