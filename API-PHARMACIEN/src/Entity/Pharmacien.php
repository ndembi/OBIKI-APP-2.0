<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PharmacienRepository")
 */
class Pharmacien
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
    private $id_pharmacie;

    /**
     * @ORM\Column(type="integer")
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $phone;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_proprietaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPharmacie(): ?int
    {
        return $this->id_pharmacie;
    }

    public function setIdPharmacie(int $id_pharmacie): self
    {
        $this->id_pharmacie = $id_pharmacie;

        return $this;
    }

    public function getSiren(): ?int
    {
        return $this->siren;
    }

    public function setSiren(int $siren): self
    {
        $this->siren = $siren;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
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

    public function getIdProprietaire(): ?int
    {
        return $this->id_proprietaire;
    }

    public function setIdProprietaire(int $id_proprietaire): self
    {
        $this->id_proprietaire = $id_proprietaire;

        return $this;
    }
}
