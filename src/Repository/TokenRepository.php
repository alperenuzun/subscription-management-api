<?php

namespace App\Repository;

use App\Entity\Token;
use App\Repository\Interfaces\TokenRepositoryInterface;
use App\Schema\TokenResponseSchema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Token|null find($id, $lockMode = null, $lockVersion = null)
 * @method Token|null findOneBy(array $criteria, array $orderBy = null)
 * @method Token[]    findAll()
 * @method Token[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TokenRepository extends ServiceEntityRepository implements TokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Token::class);
    }

    public function getToken(string $uid): ?Token
    {
        return $this->findOneBy(['uid' => $uid]);
    }

    public function exists(string $token): bool
    {
        $tokens = $this->createQueryBuilder('t')
            ->where('t.token=:token')
            ->andWhere('t.expireDate > :now')
            ->setParameter('token', $token)
            ->setParameter('now', new \DateTime())
            ->getQuery()
            ->getResult();

        return (bool)$tokens;
    }

    public function saveToken(TokenResponseSchema $tokenResponseSchema): void
    {
        $tokenEntity = (new Token())
            ->setUid($tokenResponseSchema->getUid())
            ->setToken($tokenResponseSchema->getToken())
            ->setExpireDate($tokenResponseSchema->getExpireDate());

        $this->_em->persist($tokenEntity);
        $this->_em->flush();
    }
}
