<?php


namespace App\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctrineBaseRepository implements DoctrineRepositoryInterface
{
    protected array $filter = [];

    protected EntityManagerInterface $em;

    protected string $entity;


    public function __construct(EntityManagerInterface $entityManager, string $entity)
    {
        $this->em = $entityManager;
        $this->entity = $entity;
    }


    public function setFilter(array $data): DoctrineRepositoryInterface
    {
        $this->filter = $data;

        return $this;
    }


    public function find($id)
    {
        return $this->em->find($this->entity, $id);
    }


    public function all()
    {
        return $this->makeQueryBuilderWithFilter()->getQuery()->getResult();
    }


    public function paginate($page = 1, $perPage = 25)
    {
        $query = $this->makeQueryBuilderWithFilter()
            ->setFirstResult(($page * $perPage) - $perPage)
            ->setMaxResults($perPage);

        $data = new Paginator($query, $fetchJoinCollection = true);

        return new LengthAwarePaginator($data, $data->count(), $perPage, $page, [
            "path" => request()->url()
        ]);
    }


    /**
     * @return QueryBuilder
     */
    public function makeQueryBuilder(): QueryBuilder
    {
        return $this->em->createQueryBuilder()
            ->select(['t'])
            ->from($this->entity, 't')
            ->orderBy("t.id", "desc");
    }


    public function makeQueryBuilderWithFilter(): QueryBuilder
    {
        return $this->executeFilter($this->makeQueryBuilder());
    }


    public function executeFilter(QueryBuilder $query): QueryBuilder
    {
        $filters = $this->filter;

        foreach ($filters as $key => $value)
            if (!is_null($value))
                $query->where("t.{$key} like :{$key}")
                    ->setParameter($key, "%{$value}%");

        return $query;
    }
}
