<?php



class LimitMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LimitMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('attr_limit');
		$tMap->setPhpName('Limit');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ATTR_ID', 'AttrId', 'int', CreoleTypes::INTEGER, 'attr', 'ID', true, null);

		$tMap->addColumn('LIMITATION', 'Limitation', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 