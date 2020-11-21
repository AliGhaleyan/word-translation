<?php


namespace App\Repository\Eloquent;


use App\Models\Word;
use App\Repository\BaseRepository;

class WordRepository extends BaseRepository
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
