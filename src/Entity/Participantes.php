<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participantes
 *
 * @ORM\Table(name="participantes", indexes={@ORM\Index(name="participantes_torneo_id_foreign", columns={"torneo_id"})})
 * @ORM\Entity
 */
class Participantes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidop", type="string", length=255, nullable=false)
     */
    private $apellidop;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidom", type="string", length=255, nullable=false)
     */
    private $apellidom;

    /**
     * @var int
     *
     * @ORM\Column(name="edad", type="integer", nullable=false)
     */
    private $edad;

    /**
     * @var \Torneos
     *
     * @ORM\ManyToOne(targetEntity="Torneos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="torneo_id", referencedColumnName="id")
     * })
     */
    private $torneo;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidop(): ?string
    {
        return $this->apellidop;
    }

    public function setApellidop(string $apellidop): self
    {
        $this->apellidop = $apellidop;

        return $this;
    }

    public function getApellidom(): ?string
    {
        return $this->apellidom;
    }

    public function setApellidom(string $apellidom): self
    {
        $this->apellidom = $apellidom;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getTorneo(): ?Torneos
    {
        return $this->torneo;
    }

    public function setTorneo(?Torneos $torneo): self
    {
        $this->torneo = $torneo;

        return $this;
    }


}
