<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FaitPaysRepository")
 */
class FaitPays
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total_valeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $month;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\dimensionPays")
     */
    private $pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalValeur(): ?int
    {
        return $this->total_valeur;
    }

    public function setTotalValeur(?int $total_valeur): self
    {
        $this->total_valeur = $total_valeur;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(?string $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getPays(): ?dimensionPays
    {
        return $this->pays;
    }

    public function setPays(?dimensionPays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }
}
