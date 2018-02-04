<?php
/**
 * Created by PhpStorm.
 * User: teintum
 * Date: 30/12/2017
 * Time: 23:07
 */

namespace Mte\DoctrineViewsBundle\Doctrine\View;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\Query;


class ViewManager
{
    /**
     * @var AbstractSchemaManager $schemaManager
     */
    private $schemaManager;

    /**
     * ViewManager constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->schemaManager   = $connection->getSchemaManager();
    }

    /**
     * Converts a Doctrine Query Builder Query in a Doctrine\DBAL\Schema\View object
     *
     * @param string $name Name of the view
     * @param Query $query Doctrine\ORM\Query
     * @return View
     */
    public function getViewFromQuery(string $name, Query $query):View
    {
        $converter = new QueryConverter($name, $query);
        return $converter->getView();
    }

    /**
     * Creates a view
     *
     * @param View $view
     * @return mixed
     */
    public function createView(View $view)
    {
        return $this->schemaManager->createView($view);
    }

    /**
     * Drops and creates the view
     *
     * @param View $view
     * @return mixed
     */
    public function dropAndCreateView(View $view)
    {
        return $this->schemaManager->dropAndCreateView($view);
    }

    /**
     * Converts the Query Builder query in a Doctrine\DBAL\Schema\View
     * and creates it.
     *
     * @param string $name  Name of the view
     * @param Query $query
     * @return mixed
     */
    public function createViewFromQuery(string $name, Query $query)
    {
        return $this->schemaManager->createView($this->getViewFromQuery($name, $query));
    }

    /**
     * Converts the Query Builder query in a Doctrine\DBAL\Schema\View,
     * drops and creates it.
     *
     * @param string $name  Name of the view
     * @param Query $query
     * @return mixed
     */
    public function dropAndCreateViewFromQuery(string $name, Query $query)
    {
        return $this->schemaManager->dropAndCreateView($this->getViewFromQuery($name, $query));
    }
}