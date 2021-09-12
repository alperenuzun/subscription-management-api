<?php

namespace App\Repository;

use App\Entity\Device;
use App\Repository\Interfaces\DeviceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Device|null find($id, $lockMode = null, $lockVersion = null)
 * @method Device|null findOneBy(array $criteria, array $orderBy = null)
 * @method Device[]    findAll()
 * @method Device[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceRepository extends ServiceEntityRepository implements DeviceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Device::class);
    }

    public function getDeviceByUid(int $uId): ?Device
    {
        return $this->findOneBy(['uid' => $uId]);
    }

    public function save(Device $device): void
    {
        $this->_em->persist($device);
        $this->_em->flush();
    }
}
