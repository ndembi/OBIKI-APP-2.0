<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PharmacieRepository")
 */
class Pharmacie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_pharmacien;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_proprietaire;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVille(): ?int
    {
        return $this->id_ville;
    }

    public function setIdVille(int $id_ville): self
    {
        $this->id_ville = $id_ville;

        return $this;
    }

    public function getIdPharmacien(): ?int
    {
        return $this->id_pharmacien;
    }

    public function setIdPharmacien(int $id_pharmacien): self
    {
        $this->id_pharmacien = $id_pharmacien;

        return $this;
    }

    public function getIdProprietaire(): ?int
    {
        return $this->id_proprietaire;
    }

    public function setIdProprietaire(int $id_proprietaire): self
    {
        $this->id_proprietaire = $id_proprietaire;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
