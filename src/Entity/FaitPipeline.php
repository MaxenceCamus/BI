<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FaitPipelineRepository")
 */
class FaitPipeline
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $count_valeur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $groupe_vendeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $month;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prb;

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

    public function getCountValeur(): ?int
    {
        return $this->count_valeur;
    }

    public function setCountValeur(?int $count_valeur): self
    {
        $this->count_valeur = $count_valeur;

        return $this;
    }

    public function getGroupeVendeur(): ?int
    {
        return $this->groupe_vendeur;
    }

    public function setGroupeVendeur(?int $groupe_vendeur): self
    {
        $this->groupe_vendeur = $groupe_vendeur;

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

    public function getPrb(): ?int
    {
        return $this->prb;
    }

    public function setPrb(?int $prb): self
    {
        $this->prb = $prb;

        return $this;
    }
}
