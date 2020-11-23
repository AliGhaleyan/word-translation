<?php


namespace App\Repository\Eloquent;


use App\Models\Translation;
use App\Repository\EloquentBaseRepository;

class TranslationRepositoryEloquent extends EloquentBaseRepository
{
    const PART_SPEECHES = [
        "verbs",
        "adjectives",
        "adverbs",
        "conjunctions",
        "interjections",
        "nouns",
        "prepositions",
        "pronouns",
        "articles",
    ];


    public function __construct(Translation $word)
    {
        parent::__construct($word);
    }
}
