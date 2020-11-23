<?php


namespace App\Mutation\Doctrine;


use App\Entities\Translation;
use App\Entities\Word;
use App\Mutation\DoctrineBaseMutation;
use App\Repository\Doctrine\WordRepository;
use Doctrine\ORM\EntityManagerInterface;

class TranslationMutation extends DoctrineBaseMutation
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Translation::class);
    }


    public function create($obj, array $data = [])
    {
        /** @var Translation $obj */

        /** @var Word $word */
        if (!$word = $this->findWord($data['word_id']))
            return false;

        $obj->setWord($word);

        return parent::create($obj, $data);
    }


    public function update($obj, array $data = [])
    {
        /** @var Translation $obj */

        $title = $data["title"];
        $partSpeech = $data["part_speech"];

        $obj->setTitle($title);
        $obj->setSlug($title);
        $obj->setPartSpeech($partSpeech);

        /** @var Word $word */
        if (!$word = $this->findWord($data['word_id']))
            return false;

        $obj->setWord($word);

        return parent::update($obj, $data);
    }


    public function findWord($wordId)
    {
        /** @var WordRepository $wordRepository */
        $wordRepository = resolve(WordRepository::class);

        return $wordRepository->find($wordId);
    }
}
