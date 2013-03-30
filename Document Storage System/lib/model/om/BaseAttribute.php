<?php


abstract class BaseAttribute extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type_id;


	
	protected $name;


	
	protected $tag;


	
	protected $rank;


	
	protected $required = false;


	
	protected $inreport = true;


	
	protected $insearch = true;

	
	protected $aType;

	
	protected $collLimits;

	
	protected $lastLimitCriteria = null;

	
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

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getTag()
	{

		return $this->tag;
	}

	
	public function getRank()
	{

		return $this->rank;
	}

	
	public function getRequired()
	{

		return $this->required;
	}

	
	public function getInreport()
	{

		return $this->inreport;
	}

	
	public function getInsearch()
	{

		return $this->insearch;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AttributePeer::ID;
		}

	} 
	
	public function setTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type_id !== $v) {
			$this->type_id = $v;
			$this->modifiedColumns[] = AttributePeer::TYPE_ID;
		}

		if ($this->aType !== null && $this->aType->getId() !== $v) {
			$this->aType = null;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = AttributePeer::NAME;
		}

	} 
	
	public function setTag($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag !== $v) {
			$this->tag = $v;
			$this->modifiedColumns[] = AttributePeer::TAG;
		}

	} 
	
	public function setRank($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = AttributePeer::RANK;
		}

	} 
	
	public function setRequired($v)
	{

		if ($this->required !== $v || $v === false) {
			$this->required = $v;
			$this->modifiedColumns[] = AttributePeer::REQUIRED;
		}

	} 
	
	public function setInreport($v)
	{

		if ($this->inreport !== $v || $v === true) {
			$this->inreport = $v;
			$this->modifiedColumns[] = AttributePeer::INREPORT;
		}

	} 
	
	public function setInsearch($v)
	{

		if ($this->insearch !== $v || $v === true) {
			$this->insearch = $v;
			$this->modifiedColumns[] = AttributePeer::INSEARCH;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->tag = $rs->getString($startcol + 3);

			$this->rank = $rs->getInt($startcol + 4);

			$this->required = $rs->getBoolean($startcol + 5);

			$this->inreport = $rs->getBoolean($startcol + 6);

			$this->insearch = $rs->getBoolean($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Attribute object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AttributePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AttributePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AttributePeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AttributePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AttributePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collLimits !== null) {
				foreach($this->collLimits as $referrerFK) {
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


			if (($retval = AttributePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLimits !== null) {
					foreach($this->collLimits as $referrerFK) {
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
		$pos = AttributePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 3:
				return $this->getTag();
				break;
			case 4:
				return $this->getRank();
				break;
			case 5:
				return $this->getRequired();
				break;
			case 6:
				return $this->getInreport();
				break;
			case 7:
				return $this->getInsearch();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AttributePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTypeId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getTag(),
			$keys[4] => $this->getRank(),
			$keys[5] => $this->getRequired(),
			$keys[6] => $this->getInreport(),
			$keys[7] => $this->getInsearch(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AttributePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 3:
				$this->setTag($value);
				break;
			case 4:
				$this->setRank($value);
				break;
			case 5:
				$this->setRequired($value);
				break;
			case 6:
				$this->setInreport($value);
				break;
			case 7:
				$this->setInsearch($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AttributePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTag($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRank($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRequired($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setInreport($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setInsearch($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AttributePeer::DATABASE_NAME);

		if ($this->isColumnModified(AttributePeer::ID)) $criteria->add(AttributePeer::ID, $this->id);
		if ($this->isColumnModified(AttributePeer::TYPE_ID)) $criteria->add(AttributePeer::TYPE_ID, $this->type_id);
		if ($this->isColumnModified(AttributePeer::NAME)) $criteria->add(AttributePeer::NAME, $this->name);
		if ($this->isColumnModified(AttributePeer::TAG)) $criteria->add(AttributePeer::TAG, $this->tag);
		if ($this->isColumnModified(AttributePeer::RANK)) $criteria->add(AttributePeer::RANK, $this->rank);
		if ($this->isColumnModified(AttributePeer::REQUIRED)) $criteria->add(AttributePeer::REQUIRED, $this->required);
		if ($this->isColumnModified(AttributePeer::INREPORT)) $criteria->add(AttributePeer::INREPORT, $this->inreport);
		if ($this->isColumnModified(AttributePeer::INSEARCH)) $criteria->add(AttributePeer::INSEARCH, $this->insearch);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AttributePeer::DATABASE_NAME);

		$criteria->add(AttributePeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setTag($this->tag);

		$copyObj->setRank($this->rank);

		$copyObj->setRequired($this->required);

		$copyObj->setInreport($this->inreport);

		$copyObj->setInsearch($this->insearch);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getLimits() as $relObj) {
				$copyObj->addLimit($relObj->copy($deepCopy));
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
			self::$peer = new AttributePeer();
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

	
	public function initLimits()
	{
		if ($this->collLimits === null) {
			$this->collLimits = array();
		}
	}

	
	public function getLimits($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseLimitPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLimits === null) {
			if ($this->isNew()) {
			   $this->collLimits = array();
			} else {

				$criteria->add(LimitPeer::ATTR_ID, $this->getId());

				LimitPeer::addSelectColumns($criteria);
				$this->collLimits = LimitPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LimitPeer::ATTR_ID, $this->getId());

				LimitPeer::addSelectColumns($criteria);
				if (!isset($this->lastLimitCriteria) || !$this->lastLimitCriteria->equals($criteria)) {
					$this->collLimits = LimitPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLimitCriteria = $criteria;
		return $this->collLimits;
	}

	
	public function countLimits($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseLimitPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LimitPeer::ATTR_ID, $this->getId());

		return LimitPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addLimit(Limit $l)
	{
		$this->collLimits[] = $l;
		$l->setAttribute($this);
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

				$criteria->add(ValuePeer::ATTR_ID, $this->getId());

				ValuePeer::addSelectColumns($criteria);
				$this->collValues = ValuePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ValuePeer::ATTR_ID, $this->getId());

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

		$criteria->add(ValuePeer::ATTR_ID, $this->getId());

		return ValuePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addValue(Value $l)
	{
		$this->collValues[] = $l;
		$l->setAttribute($this);
	}


	
	public function getValuesJoinDocument($criteria = null, $con = null)
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

				$criteria->add(ValuePeer::ATTR_ID, $this->getId());

				$this->collValues = ValuePeer::doSelectJoinDocument($criteria, $con);
			}
		} else {
									
			$criteria->add(ValuePeer::ATTR_ID, $this->getId());

			if (!isset($this->lastValueCriteria) || !$this->lastValueCriteria->equals($criteria)) {
				$this->collValues = ValuePeer::doSelectJoinDocument($criteria, $con);
			}
		}
		$this->lastValueCriteria = $criteria;

		return $this->collValues;
	}

} 