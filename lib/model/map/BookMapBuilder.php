<?php


/**
 * This class adds structure of 'book' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * 05/19/09 16:14:37
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class BookMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.BookMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(BookPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(BookPeer::TABLE_NAME);
		$tMap->setPhpName('Book');
		$tMap->setClassname('Book');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ISBN10', 'Isbn10', 'VARCHAR', true, 10);

		$tMap->addColumn('ISBN13', 'Isbn13', 'BIGINT', false, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('IMAGEPATH', 'Imagepath', 'LONGVARCHAR', false, null);

		$tMap->addColumn('PUBLISHED', 'Published', 'TIMESTAMP', false, null);

	} // doBuild()

} // BookMapBuilder
