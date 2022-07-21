<?php

namespace GAR\Util\XMLReader\Files\Single;

use GAR\Database\Table\SQL\QueryModel;
use GAR\Entity\EntityFactory;
use GAR\Util\XMLReader\Files\XMLFile;

class AsObjectLevels extends XMLFile
{
    public static function getQueryModel(): QueryModel
    {
        return EntityFactory::getObjectLevels();
    }

    /**
     * return elements of xml document
     * @return string elements names
     */
    public static function getElement(): string
    {
        return 'OBJECTLEVEL';
    }

    /**
     * return attributes of elements in xml document
     * @return array attributes names
     */
    public static function getAttributes(): array
    {
        return [
      'LEVEL' => 'int',
      'NAME' => 'string',
      'ISACTIVE' => 'bool',
    ];
    }

    /**
     * procedure that contains main operations from exec method
     * @param array $values current parse element
     * @return void
     */
    public function execDoWork(array $values): void
    {
        static::getQueryModel()->forceInsert([
      $values['LEVEL'],
      $values['NAME']
    ]);
    }
}
