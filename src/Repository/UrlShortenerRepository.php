<?php

namespace App\Repository;

use App\Entity\UrlShortener;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use UrlShortener\Repositories\IRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UrlShortener>
 *
 * @method UrlShortener|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlShortener|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlShortener[]    findAll()
 * @method UrlShortener[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlShortenerRepository extends ServiceEntityRepository implements IRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlShortener::class);
    }

    public function save(UrlShortener $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UrlShortener $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UrlShortener[] Returns an array of UrlShortener objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UrlShortener
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function read(): array
    {
        // TODO: Implement read() method.
        return [];
    }

    public function write(string $url, string $code): void
    {
        // TODO: Implement write() method.
        $em = $this->getEntityManager();
        $urlShortener = new UrlShortener();
        $urlShortener->setUrl($url);
        $urlShortener->setCode($code);
        $em->persist($urlShortener);
        try {
            $em->flush();
        } catch (UniqueConstraintViolationException){
            dd('Записати в бд можна тільки по унікальному URL. Такий URL в базі вже існує');
        }
    }
}
