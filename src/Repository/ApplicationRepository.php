<?php

namespace App\Repository;

use App\Entity\Application;
use App\Repository\Interfaces\ApplicationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Application|null find($id, $lockMode = null, $lockVersion = null)
 * @method Application|null findOneBy(array $criteria, array $orderBy = null)
 * @method Application[]    findAll()
 * @method Application[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationRepository extends ServiceEntityRepository implements ApplicationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    public function getApplicationById(int $id): ?Application
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function save(Application $application): void
    {
        $this->_em->persist($application);
        $this->_em->flush();
    }
}
