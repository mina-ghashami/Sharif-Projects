<?php



class SharedMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SharedMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('shared');
		$tMap->setPhpName('Shared');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('DOC_ID', 'DocId', 'int', CreoleTypes::INTEGER, 'document', 'ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'user', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 