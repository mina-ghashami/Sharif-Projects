<?php


abstract class BaseAttributePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'attr';

	
	const CLASS_DEFAULT = 'lib.model.Attribute';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'attr.ID';

	
	const TYPE_ID = 'attr.TYPE_ID';

	
	const NAME = 'attr.NAME';

	
	const TAG = 'attr.TAG';

	
	const RANK = 'attr.RANK';

	
	const REQUIRED = 'attr.REQUIRED';

	
	const INREPORT = 'attr.INREPORT';

	
	const INSEARCH = 'attr.INSEARCH';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'TypeId', 'Name', 'Tag', 'Rank', 'Required', 'Inreport', 'Insearch', ),
		BasePeer::TYPE_COLNAME => array (AttributePeer::ID, AttributePeer::TYPE_ID, AttributePeer::NAME, AttributePeer::TAG, AttributePeer::RANK, AttributePeer::REQUIRED, AttributePeer::INREPORT, AttributePeer::INSEARCH, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'type_id', 'name', 'tag', 'rank', 'required', 'inReport', 'inSearch', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TypeId' => 1, 'Name' => 2, 'Tag' => 3, 'Rank' => 4, 'Required' => 5, 'Inreport' => 6, 'Insearch' => 7, ),
		BasePeer::TYPE_COLNAME => array (AttributePeer::ID => 0, AttributePeer::TYPE_ID => 1, AttributePeer::NAME => 2, AttributePeer::TAG => 3, AttributePeer::RANK => 4, AttributePeer::REQUIRED => 5, AttributePeer::INREPORT => 6, AttributePeer::INSEARCH => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'type_id' => 1, 'name' => 2, 'tag' => 3, 'rank' => 4, 'required' => 5, 'inReport' => 6, 'inSearch' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AttributeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AttributeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AttributePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(AttributePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AttributePeer::ID);

		$criteria->addSelectColumn(AttributePeer::TYPE_ID);

		$criteria->addSelectColumn(AttributePeer::NAME);

		$criteria->addSelectColumn(AttributePeer::TAG);

		$criteria->addSelectColumn(AttributePeer::RANK);

		$criteria->addSelectColumn(AttributePeer::REQUIRED);

		$criteria->addSelectColumn(AttributePeer::INREPORT);

		$criteria->addSelectColumn(AttributePeer::INSEARCH);

	}

	const COUNT = 'COUNT(attr.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT attr.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AttributePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AttributePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AttributePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AttributePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AttributePeer::populateObjects(AttributePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AttributePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AttributePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AttributePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AttributePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AttributePeer::TYPE_ID, TypePeer::ID);

		$rs = AttributePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AttributePeer::addSelectColumns($c);
		$startcol = (AttributePeer::NUM_COLUMNS - AttributePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TypePeer::addSelectColumns($c);

		$c->addJoin(AttributePeer::TYPE_ID, TypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AttributePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAttribute($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAttributes();
				$obj2->addAttribute($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AttributePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AttributePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AttributePeer::TYPE_ID, TypePeer::ID);

		$rs = AttributePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AttributePeer::addSelectColumns($c);
		$startcol2 = (AttributePeer::NUM_COLUMNS - AttributePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TypePeer::NUM_COLUMNS;

		$c->addJoin(AttributePeer::TYPE_ID, TypePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AttributePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = TypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAttribute($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAttributes();
				$obj2->addAttribute($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return AttributePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(AttributePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AttributePeer::ID);
			$selectCriteria->add(AttributePeer::ID, $criteria->remove(AttributePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += AttributePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(AttributePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(AttributePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Attribute) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AttributePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += AttributePeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = AttributePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Limit.php';

						$c = new Criteria();
			
			$c->add(LimitPeer::ATTR_ID, $obj->getId());
			$affectedRows += LimitPeer::doDelete($c, $con);

			include_once 'lib/model/Value.php';

						$c = new Criteria();
			
			$c->add(ValuePeer::ATTR_ID, $obj->getId());
			$affectedRows += ValuePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Attribute $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AttributePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AttributePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(AttributePeer::DATABASE_NAME, AttributePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AttributePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(AttributePeer::DATABASE_NAME);

		$criteria->add(AttributePeer::ID, $pk);


		$v = AttributePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(AttributePeer::ID, $pks, Criteria::IN);
			$objs = AttributePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAttributePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/AttributeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AttributeMapBuilder');
}
