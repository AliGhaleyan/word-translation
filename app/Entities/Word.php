<?php


namespace App\Entities;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Word
 * @package App\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="words")
 */
class Word
{
    use Timestampable;

    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="bigint") */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $title;

    /** @ORM\Column(type="string") */
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="word", cascade={"persist"})
     * @var ArrayCollection|Translation[]
     */
    protected $translations;


    public function __construct(string $title)
    {
        $this->title = $title;
        $this->setSlug($title);
        $this->translations = new ArrayCollection;
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }


    /**
     * @return mixed
     */
    public function getTranslations()
    {
        return $this->translations;
    }


    /**
     * @param Translation $translation
     */
    public function addTranslation(Translation $translation)
    {
        if (!$this->translations->contains($translation)) {
            $translation->setWord($this);
            $this->translations->add($translation);
        }
    }


    /**
     * @param array $translations
     */
    public function addTranslations(array $translations)
    {
        /** @var Translation $translation */
        foreach ($translations as $translation) {
            if (!$this->translations->contains($translation)) {
                $translation->setWord($this);
                $this->translations->add($translation);
            }
        }
    }


    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = (new Slugify())->slugify($slug);
    }
}
