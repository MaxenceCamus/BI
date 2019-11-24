<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FaitPerfComRepository")
 */
class FaitPerfCom
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
    private $nbs_offre;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\dimensionTemps")
     */
    private $temps;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total_vente;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $moyenne_vente;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bns_commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbsOffre(): ?int
    {
        return $this->nbs_offre;
    }

    public function setNbsOffre(?int $nbs_offre): self
    {
        $this->nbs_offre = $nbs_offre;

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

    public function getTemps(): ?dimensionTemps
    {
        return $this->temps;
    }

    public function setTemps(?dimensionTemps $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getTotalVente(): ?int
    {
        return $this->total_vente;
    }

    public function setTotalVente(?int $total_vente): self
    {
        $this->total_vente = $total_vente;

        return $this;
    }

    public function getMoyenneVente(): ?int
    {
        return $this->moyenne_vente;
    }

    public function setMoyenneVente(?int $moyenne_vente): self
    {
        $this->moyenne_vente = $moyenne_vente;

        return $this;
    }

    public function getBnsCommande(): ?int
    {
        return $this->bns_commande;
    }

    public function setBnsCommande(?int $bns_commande): self
    {
        $this->bns_commande = $bns_commande;

        return $this;
    }
}
