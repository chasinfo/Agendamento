<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente", uniqueConstraints={@ORM\UniqueConstraint(name="UN_EMAIL", columns={"EMAIL"})}, indexes={@ORM\Index(name="IDX_NOME", columns={"NOME"}), @ORM\Index(name="FK_USUARIO_CLIENTE", columns={"ID_USUARIO"})})
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CLIENTE", type="integer", nullable=false, options={"comment"="Identificador do cliente."})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOME", type="string", length=60, nullable=false, options={"comment"="Nome do cliente"})
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=100, nullable=false, options={"comment"="Email do cliente."})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONE", type="string", length=11, nullable=false, options={"comment"="Telefone do cliente."})
     */
    private $telefone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ATUALIZACAO", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="Registra a data e hora da última atualização."})
     */
    private $atualizacao = 'CURRENT_TIMESTAMP';

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO", referencedColumnName="ID_USUARIO")
     * })
     */
    private $idUsuario;

    public function getIdCliente(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

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

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getAtualizacao(): ?\DateTimeInterface
    {
        return $this->atualizacao;
    }

    public function setAtualizacao(\DateTimeInterface $atualizacao): self
    {
        $this->atualizacao = $atualizacao;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
