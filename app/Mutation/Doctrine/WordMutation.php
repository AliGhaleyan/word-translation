<?php


namespace App\Mutation\Doctrine;


use App\Entities\Word;
use App\Mutation\DoctrineBaseMutation;
use Doctrine\ORM\EntityManagerInterface;

class WordMutation extends DoctrineBaseMutation
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Word::class);
    }


    public function update($obj, array $data = [])
    {
        /** @var Word $obj */
        $obj->setTitle($data['title']);
        $obj->setSlug($data['title']);
        $obj->setUpdatedAt(new \DateTime());

        return parent::update($obj, $data);
    }
}
