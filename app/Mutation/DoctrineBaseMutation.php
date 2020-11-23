<?php


namespace App\Mutation;


use Doctrine\ORM\EntityManagerInterface;

class DoctrineBaseMutation implements DoctrineMutationInterface
{
    protected EntityManagerInterface $em;

    protected string $entity;


    public function __construct(EntityManagerInterface $entityManager, string $entity)
    {
        $this->em = $entityManager;
        $this->entity = $entity;
    }


    public function create($obj, array $data = [])
    {
        $this->em->persist($obj);
        $this->em->flush();

        return $obj;
    }


    public function update($obj, array $data = [])
    {
        $this->em->flush();

        return $obj;
    }


    public function delete($obj)
    {
        $this->em->remove($obj);
        $this->em->flush();

        return true;
    }
}
