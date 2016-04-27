<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Filmes")
 */
class Filmes 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *
     * @ORM\Column(type="string", length=200)
     */
    private $nome;
    
    /**
     * @ORM\Column(type="string", length=80)
     * 
     */
    private $genero;
    
    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $lancamento;
    
    
    
    public function getId() 
    {
        return $this->id;
    }
    /**
     * 
     * @return String
     */
    public function getNome() 
    {
        return $this->nome;
    }
    /**
     * 
     * @return String
     */
    public function getGenero() 
    {
        return $this->genero;
    }
    /**
     * 
     * @return Boolean
     */
    public function getLancamento() 
    {
        return $this->lancamento;
    }
    /**
     * 
     * @param String $nome
     */
    public function setNome($nome) 
    {
        $this->nome = $nome;
    }
    /**
     * 
     * @param String $genero
     */
    public function setGenero($genero) 
    {
        $this->genero = $genero;
    }
    /**
     * 
     * @param boolean $lancamento
     */
    public function setLancamento($lancamento)
    {
        if (is_bool($lancamento))
        {
            $this->lancamento = $lancamento;
        }else{
            throw new BadMethodCallException("O valor deve ser do tipo boleano");
        }
        
    }


}



