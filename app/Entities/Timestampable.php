<?php


namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

trait Timestampable
{
    /** @ORM\Column(type="datetime") */
    protected \DateTime $createdAt;

    /** @ORM\Column(type="datetime", nullable=true) */
    protected \DateTime $updatedAt;


    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt->format("Y-m-d H:i:s");
    }


    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt->format("Y-m-d H:i:s");
    }


    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }


    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
