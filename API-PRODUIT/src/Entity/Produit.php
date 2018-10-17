<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $classe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_expiration;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $id_ordonnance;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_proprietaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_produit_specifique;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(\DateTimeInterface $date_expiration): self
    {
        $this->date_expiration = $date_expiration;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getIdOrdonnance(): ?string
    {
        return $this->id_ordonnance;
    }

    public function setIdOrdonnance(string $id_ordonnance): self
    {
        $this->id_ordonnance = $id_ordonnance;

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

    public function getIdProduitSpecifique(): ?int
    {
        return $this->id_produit_specifique;
    }

    public function setIdProduitSpecifique(int $id_produit_specifique): self
    {
        $this->id_produit_specifique = $id_produit_specifique;

        return $this;
    }
}
