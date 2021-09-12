<?php

namespace App\Repository;

use App\Entity\Client;
use App\Repository\Interfaces\ClientRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function getClient(int $deviceId, int $appId): ?Client
    {
        return $this->findOneBy(['device' => $deviceId, 'app' => $appId]);
    }

    public function save(Client $client): void
    {
        $this->_em->persist($client);
        $this->_em->flush();
    }

    public function flush(): void
    {
        $this->_em->flush();
    }
}
