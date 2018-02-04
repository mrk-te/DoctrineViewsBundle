# MteDoctrineViewsBundle

Converts a Doctrine\ORM\Query in a Doctrine\DBAL\Schema\View. 

Provides a manager class to convert, create, and the views.

## Configuration

```
mte_doctrine_views:
    dbal:

        # Example:
        default:             database_connection

        # Prototype
        name:                 ~
```

Generates a service "mte.doctrine_views.manager.default" associated to the DBAL service "database\_connection"

```
Information for Service "mte.doctrine_views.manager.default"
============================================================

 ---------------- ---------------------------------------------------
  Option           Value
 ---------------- ---------------------------------------------------
  Service ID       mte.doctrine_views.manager.default
  Class            Mte\DoctrineViewsBundle\Doctrine\View\ViewManager
  Tags             -
  Public           yes
  Synthetic        no
  Lazy             no
  Shared           yes
  Abstract         no
  Autowired        no
  Autoconfigured   no
 ---------------- ---------------------------------------------------
```


## Usage 

Get the Doctrine Query Builder query :

```php
class UserRepository extends ServiceEntityRepository
{
    public function createUserViewQuery()
    {
        $qb     = $this->createQueryBuilder('u');

        return $qb->select('u.id')
            ->addSelect('CONCAT(u.username, \'@\', d.name) AS user')
            ->addSelect('u.password')
            ->join('u.domain', 'd')
            ->where('u.enabled = true')
            ->andWhere('d.enabled = true')
            ->getQuery();
    }
}
```

Use the manager to handle your view

```php
/**
 * @var App\Repository\UserRepository $userRepository
 */
$query	= $userRepository->createUserViewQuery();

/**
 * Converts the Doctrine\ORM\Query $query in Doctrine\DBAL\Schema\View
 * @var Mte\DoctrineViewsBundle\Doctrine\View\ViewManager $viewManager
 * @see #Configuration
 */
$view 	= $viewManager->getViewFromQuery('my_user_view', $query);

/**
 * Creates the given view
 */
$viewManager->createView($view)

/**
 * Drops the given View if exists
 * Creates the given view
 */
$viewManager->dropAndCreateView($view)

/**
 * Converts the Doctrine\ORM\Query $query in Doctrine\DBAL\Schema\View
 * Creates the given view
 */
$viewManager->createViewFromQuery('my_user_view', $query)

/**
 * Converts the Doctrine\ORM\Query $query in Doctrine\DBAL\Schema\View
 * Drops the given View if exists
 * Creates the given view
 */
$viewManager->dropAndCreateViewFromQuery(string $name, Query $query)

```


