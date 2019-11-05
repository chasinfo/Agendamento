<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servico
 *
 * @ORM\Table(name="servico", indexes={@ORM\Index(name="FK_USUARIIO_SERVICO", columns={"ID_USUARIO"}), @ORM\Index(name="IDX_NOME", columns={"NOME"})})
 * @ORM\Entity(repositoryClass="App\Repository\ServicoRepository")
 */
class Servico
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_SERVICO", type="integer", nullable=false, options={"comment"="Identificação do cadastro serviço"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOME", type="string", length=100, nullable=false, options={"comment"="Mantém o nome do serviço."})
     */
    private $nome;

    /**
     * @var float
     *
     * @ORM\Column(name="VALOR", type="float", precision=10, scale=2, nullable=false, options={"comment"="Mantém o valor do serviço."})
     */
    private $valor;

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

    public function getId(): ?int
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

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

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
