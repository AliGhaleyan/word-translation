<?php


namespace App\Repository\Eloquent;


use App\Models\Word;
use App\Repository\EloquentBaseRepository;

class WordRepositoryEloquent extends EloquentBaseRepository
{
    public function __construct(Word $word)
    {
        parent::__construct($word);
    }

    public function paginate($perPage = 25)
    {
        return Word::filter()->latest()->paginate($perPage);
    }
}
