# MteDoctrineViewsBundle

## Configuration

## Usage 

Converts a Doctrine\ORM\Query in a Doctrine\DBAL\Schema\View. 

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
