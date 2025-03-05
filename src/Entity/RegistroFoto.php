<?php

namespace App\Entity;

use App\Repository\RegistroFotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistroFotoRepository::class)]
class RegistroFoto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombrePersona = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreArchivo = null;

    #[ORM\Column(length: 50)]
    private ?string $formaPago = null;

    #[ORM\Column(length: 50)]
    private ?string $telefono = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?bool $entregado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePersona(): ?string
    {
        return $this->nombrePersona;
    }

    public function setNombrePersona(string $nombrePersona): static
    {
        $this->nombrePersona = $nombrePersona;

        return $this;
    }

    public function getNombreArchivo(): ?string
    {
        return $this->nombreArchivo;
    }

    public function setNombreArchivo(string $nombreArchivo): static
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    public function getFormaPago(): ?string
    {
        return $this->formaPago;
    }

    public function setFormaPago(string $formaPago): static
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isEntregado(): ?bool
    {
        return $this->entregado;
    }

    public function setEntregado(?bool $entregado): static
    {
        $this->entregado = $entregado;

        return $this;
    }
}

