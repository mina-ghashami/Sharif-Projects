<?php



class ValueMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ValueMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('value');
		$tMap->setPhpName('Value');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('DOC_ID', 'DocId', 'int', CreoleTypes::INTEGER, 'document', 'ID', true, null);

		$tMap->addForeignKey('ATTR_ID', 'AttrId', 'int', CreoleTypes::INTEGER, 'attr', 'ID', true, null);

		$tMap->addColumn('VAL', 'Val', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 