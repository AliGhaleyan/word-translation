<?php


namespace App\Http\Controllers;


use App\Mutation\DoctrineMutationInterface;
use App\Repository\DoctrineBaseRepository;

class BaseController extends Controller
{
    protected DoctrineBaseRepository $repository;

    protected DoctrineMutationInterface $mutation;


    public function findById($id)
    {
        return $this->repository->find($id);
    }
}
