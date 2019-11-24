<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DimensionPaysRepository")
 */
class DimensionPays
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePays(): ?string
    {
        return $this->code_pays;
    }

    public function setCodePays(string $code_pays): self
    {
        $this->code_pays = $code_pays;

        return $this;
    }
}
