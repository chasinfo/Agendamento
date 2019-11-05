<?php
namespace App\Repository;

use App\Entity\Profissional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProfissionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profissional::class);
    }

    public function fetchPairs()
    {
        $dados = $this->findAll();
        $result = [];
        foreach($dados as $d) {
            $result[$d->getNome()] = $d->getId();
        }
        return $result;
    }

}