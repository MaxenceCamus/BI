<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DimensionOffreCommandeRepository")
 */
class DimensionOffreCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $month;

    /**
     * @ORM\Column(type="integer")
     */
    private $doc_vente;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $don_ordre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $groupe_vendeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeDC;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $valeur_nette;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prb;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDocVente(): ?int
    {
        return $this->doc_vente;
    }

    public function setDocVente(int $doc_vente): self
    {
        $this->doc_vente = $doc_vente;

        return $this;
    }

    public function getDonOrdre(): ?int
    {
        return $this->don_ordre;
    }

    public function setDonOrdre(?int $don_ordre): self
    {
        $this->don_ordre = $don_ordre;

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

    public function getTypeDC(): ?string
    {
        return $this->typeDC;
    }

    public function setTypeDC(?string $typeDC): self
    {
        $this->typeDC = $typeDC;

        return $this;
    }

    public function getValeurNette(): ?float
    {
        return $this->valeur_nette;
    }

    public function setValeurNette(?float $valeur_nette): self
    {
        $this->valeur_nette = $valeur_nette;

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
