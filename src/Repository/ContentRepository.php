<?php

namespace ProxiCMS\ContentBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use ProxiCMS\ContentBundle\Entity\Content;
use ProxiCMS\ContentBundle\Entity\ContentInterface;

/**
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository implements ContentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Content::class);
    }

    public function add(ContentInterface $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Content $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllPublicIndexByIdentifier(): array
    {
        return $this->createQueryBuilder('c')
            ->indexBy('c', 'c.identifier')
            ->select(['c.identifier', 'c.category', 'c.name', 'c.value', 'c.textEditor'])
            ->andWhere('c.public = true')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupérer ou créer la variable en BDD à partir du "identifier".
     */
    public function findOrCreateOneByIdentifier(string $identifier, string $value = null): ?ContentInterface
    {
        $content = $this->createQueryBuilder('c')
            ->andWhere('c.identifier = :identifier')
            ->setParameter('identifier', $identifier)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        if (null === $content) {
            $content = new Content($identifier, $identifier, $value);
            $this->_em->persist($content);
            $this->_em->flush();
        }

        return $content;
    }
}
