<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilmesController extends Controller
{    
    /**
     * @Route("/filmes", name="filmes_index")
     */
    public function indexAction()
    {
        return $this->render('filmes/index.html.twig');
    }
    
    /**
     * @Route("/filmes/cadastro")
     */
    public function CadastroAction()
    {
        return $this->render('filmes/cadastro.html.twig');
    }
}
