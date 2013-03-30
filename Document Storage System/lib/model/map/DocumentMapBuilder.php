<?php



class DocumentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DocumentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('document');
		$tMap->setPhpName('Document');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'type', 'ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'user', 'ID', true, null);

		$tMap->addColumn('PATH', 'Path', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 