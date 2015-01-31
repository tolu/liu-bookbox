<?php


/**
 * This class adds structure of 'books' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * 05/04/09 09:08:27
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class BooksMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.BooksMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(BooksPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(BooksPeer::TABLE_NAME);
		$tMap->setPhpName('Books');
		$tMap->setClassname('Books');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('ISBN10', 'Isbn10', 'VARCHAR', 'book', 'ISBN10', false, 10);

		$tMap->addForeignKey('SELLER_ID', 'SellerId', 'INTEGER', 'user', 'ID', false, null);

		$tMap->addColumn('BOOKQUALITY', 'Bookquality', 'INTEGER', false, null);

		$tMap->addColumn('ADDED_ON', 'AddedOn', 'TIMESTAMP', false, null);

		$tMap->addColumn('PRICE', 'Price', 'FLOAT', false, null);

		$tMap->addColumn('IS_CHECKED_OUT', 'IsCheckedOut', 'TIMESTAMP', false, null);

	} // doBuild()

} // BooksMapBuilder
