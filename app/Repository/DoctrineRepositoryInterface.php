<?php


namespace App\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

interface DoctrineRepositoryInterface
{
    public function setFilter(array $data): DoctrineRepositoryInterface;


    public function find($id);


    public function all();


    public function paginate($page = 1, $perPage = 25);


    public function makeQueryBuilder(): QueryBuilder;


    public function executeFilter(QueryBuilder $query): QueryBuilder;
}
