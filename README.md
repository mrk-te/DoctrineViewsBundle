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
    public function createDovecotUserViewQuery()
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

```


