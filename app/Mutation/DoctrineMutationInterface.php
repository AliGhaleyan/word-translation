<?php


namespace App\Mutation;


interface DoctrineMutationInterface
{
    public function create($obj, array $data = []);


    public function update($obj, array $data = []);


    public function delete($obj);
}
