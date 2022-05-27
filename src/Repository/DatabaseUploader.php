<?php declare(strict_types=1);

namespace GAR\Repository;

use GAR\Entity\EntityFactory;
use GAR\Util\XMLReader\XMLReaderFactory;

class DatabaseUploader
{
  private array $tables;

  /**
   * @param EntityFactory $tables
   */
  public function __construct(EntityFactory $tables)
  {
    $this->tables = [
      'level_obj' => $tables::getObjectLevels(),
      'housetype' => $tables::getHousetype(),
      'addhousetype' => $tables::getAddhousetype(),
      'addr_obj' => $tables::getAddressObjectTable(),
      'addr_obj_params' => $tables::getAddressObjectParamsTable(),
      'houses' => $tables::getHousesTable(),
      'mun_hierarchy' => $tables::getMunTable()
    ];
  }

  public function upload(XMLReaderFactory $readerFactory) : void {
    $readerGroup = [
      'level_obj' => $readerFactory::execObjectLevels(),
      'housetype' => $readerFactory::execHousetype(),
      'addhousetype' => $readerFactory::execAddhousetype(),
      'addr_obj' => $readerFactory::execAddrObj(),
      'addr_obj_params' => $readerFactory::execAddressObjParams(),
      'houses' => $readerFactory::execHouses(),
      'mun_hierarchy' => $readerFactory::execMunHierachi(),
    ];

    foreach ($readerGroup as $name => $reader) {
      $reader->exec($this->tables[$name]);
    }
  }
}