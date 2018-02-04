<?php
/**
 * Created by PhpStorm.
 * User: teintum
 * Date: 30/12/2017
 * Time: 23:17
 */

namespace Mte\DoctrineViewsBundle\Doctrine\View;


use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\Query;

class QueryConverter
{
    /**
     * @var Query $query
     */
    private $query;

    /**
     * @var string $name
     */
    private $name;


    /**
     * QueryConverter constructor.
     *
     * @param string $name Name of the view
     * @param Query $query
     */
    public function __construct(string $name, Query $query)
    {
        $this->name     = $name;
        $this->query    = $query;
    }

    /**
     * Converts the Query in View
     *
     * @return View
     */
    public function getView():View
    {
        $parser         = new Query\Parser($this->query);
        $parserResult   = $parser->parse();
        $mapping        = $parserResult->getResultSetMapping();
        $sql            = $this->query->getSQL();

        foreach ($mapping->scalarMappings as $dql => $name) {
            $sql    = str_replace($dql, $name, $sql);
        }

        return new View($this->name, $sql);
    }
}