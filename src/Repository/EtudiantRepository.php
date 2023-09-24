<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    /**
     * @return Etudiant[] Returns an array of Etudiant objects
     */
    public function findMineurs(): array
    {
        $dateMajorite = new \DateTime("-18 years");
        return $this->createQueryBuilder('e')
            ->andWhere('e.dateNaissance > :dateMajorite')
            ->setParameter('dateMajorite', $dateMajorite)
            ->getQuery()
            ->getResult();
    }
    /**
     * @return Etudiant[] Returns an array of Etudiant objects
     */
    public function findMineurs2(): array
    {
        $dateMajorite = new \DateTime("-18 years");

        // Exprimer la requete
        $requestDQL = "SELECT etudiant FROM App\Entity\Etudiant AS etudiant WHERE etudiant.dateNaissance > :dateMajorite";

        // Construire la requete
        $request = $this->getEntityManager()->createQuery($requestDQL);
        $request->setParameter("dateMajorite",$dateMajorite);
        return $request->getResult();
    }
    /**
     * @return Etudiant[] Returns an array of Etudiant objects
     */
    public function findByPromotion(int $id): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.Promotion = :idPromotion')
            ->setParameter('idPromotion', $id)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Etudiant[] Returns an array of Etudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etudiant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
