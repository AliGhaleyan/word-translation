<?php


namespace App\Repository\Doctrine;


use App\Entities\Translation;
use App\Repository\DoctrineBaseRepository;
use Doctrine\ORM\EntityManagerInterface;

class TranslationRepository extends DoctrineBaseRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Translation::class);
    }
}
