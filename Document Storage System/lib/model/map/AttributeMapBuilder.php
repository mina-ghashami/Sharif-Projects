<?php



class AttributeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AttributeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('attr');
		$tMap->setPhpName('Attribute');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'type', 'ID', true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('TAG', 'Tag', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('REQUIRED', 'Required', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INREPORT', 'Inreport', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INSEARCH', 'Insearch', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 