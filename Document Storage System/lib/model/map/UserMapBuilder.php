<?php



class UserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('user');
		$tMap->setPhpName('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('STUDENT_ID', 'StudentId', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('MAJOR', 'Major', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('LEVEL', 'Level', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('PHONE', 'Phone', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('CREDENTIAL', 'Credential', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 