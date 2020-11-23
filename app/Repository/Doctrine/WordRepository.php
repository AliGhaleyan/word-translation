<?php


namespace App\Repository\Doctrine;


use App\Entities\Word;
use App\Repository\DoctrineBaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class WordRepository extends DoctrineBaseRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Word::class);
    }
}
