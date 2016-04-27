<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="genero")
 */
class Genero 
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="string", length=80)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nome;
    
    /**
     * 
     * @return string
     */
    public function getNome() 
    {
        return $this->nome;
    }
    
    /**
     * 
     * @param string $nome
     */
    public function setNome($nome) 
    {
        $this->nome = $nome;
    }


}
