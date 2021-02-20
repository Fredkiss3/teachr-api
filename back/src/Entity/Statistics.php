<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_teachrs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumTeachrs(): ?int
    {
        return $this->num_teachrs;
    }

    public function setNumTeachrs(int $num_teachrs): self
    {
        $this->num_teachrs = $num_teachrs;

        return $this;
    }
}
