<?php


namespace App\Entities;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Translation
 * @package App\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="translations")
 */
class Translation
{
    use Timestampable;

    /** @ORM\ID @ORM\GeneratedValue @ORM\Column(type="bigint") */
    protected int $id;

    /** @ORM\Column(type="string") */
    protected string $title;

    /** @ORM\Column(type="string") */
    protected string $slug;

    /** @ORM\Column(type="string") */
    protected string $partSpeech;

    /** @ORM\ManyToOne(targetEntity="Word", inversedBy="translations") */
    protected Word $word;


    public function __construct(string $title, string $partSpeech)
    {
        $this->title = $title;
        $this->setSlug($title);
        $this->partSpeech = $partSpeech;
        $this->createdAt = new \DateTime();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * @return mixed
     */
    public function getPartSpeech()
    {
        return $this->partSpeech;
    }


    /**
     * @return mixed
     */
    public function getWord()
    {
        return $this->word;
    }


    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = (new Slugify())->slugify($slug);
    }


    /**
     * @param mixed $partSpeech
     */
    public function setPartSpeech($partSpeech)
    {
        $this->partSpeech = $partSpeech;
    }


    /**
     * @param mixed $word
     */
    public function setWord(Word $word)
    {
        $this->word = $word;
    }
}
