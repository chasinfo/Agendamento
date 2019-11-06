<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="UN_LOGIN", columns={"LOGIN"}), @ORM\UniqueConstraint(name="UN_EMAIL", columns={"EMAIL"})}, indexes={@ORM\Index(name="IDX_NOME", columns={"NOME"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false, options={"comment"="Indentificador do usuário."})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NOME", type="string", length=60, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=30, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="SENHA", type="string", length=100, nullable=false)
     */
    private $senha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ATUALIZACAO", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $atualizacao = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="PERFIL", type="string", length=1, nullable=false, options={"default"="F","fixed"=true,"comment"="Perfil de acesso ao sistema. C: Usuário Cliente; F: Usuário Funcionário"})
     */
    private $perfil = 'F';

    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

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

    public function getPerfil(): ?string
    {
        return $this->perfil;
    }

    public function setPerfil(string $perfil): self
    {
        $this->perfil = $perfil;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }


}
