<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Filmes;
use AppBundle\Entity\Genero;

use AppBundle\Form\FilmesType;

class FilmesController extends Controller
{
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEm()
    {
        return  $this->getDoctrine()->getManager();
    }


    /**
     * @Route("/filmes", name="filmes_index")
     */
    public function indexAction()
    {
        /*Model*/
        
        $filmes = $this->getEm()->getRepository('AppBundle:Filmes');
        
      /*  $retorno = $filmes->findBy(
                 array('genero'=>'Terror',
                'lancamento' => false
                     )
                );
        */
        
        $retorno = $filmes->findAll();
        
        /*View*/
        return $this->render('filmes/index.html.twig', 
                array('filmes' => $retorno)
        );
    }
    
    /**
     * @Route("/filmes/cadastro")
     */
    public function cadastroAction(Request $request)
    {
        $filme = new filmes();
        $form = $this->createForm(FilmesType::class, $filme);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $doctrine = $this->getEm();
            $doctrine->persist($filme);
            $doctrine->flush();
            
            return $this->redirectToRoute('filmes_index');
        }
        
        return $this->render('filmes/cadastro.html.twig', array(
           'form_filmes'=> $form->createView()
        ));
    }
    /**
     * @Route("/filmes/genero", name="genero_index")
     */
    public function generoAction()
    {
          $repositorio = $this->getEm()->getRepository("AppBundle:Genero");
          
          $dados = $repositorio->findBy(array(), array('nome'=>"ASC"));
        
          return $this->render('filmes/genero.html.twig', array(
              'dados' => $dados
          ));
    }
    /**
     * @Route ("/filmes/genero/cadastro", name="genero_cadastro")
     */
    public function generoCadastroAction()
    {
        return $this->render('filmes/genero-cadastro.html.twig');
    }
    
    /**
     * @Route ("/filmes/genero/criar")
     */
    public function criarGeneroAction(Request $request)
    {
        $nomeGenero = $request->get('nome');
        
        $genero = new Genero();
        $genero->setNome($nomeGenero);
        
        $doctrine = $this->getEm();
        $doctrine->persist($genero);
        
        $doctrine->flush();
        
        return $this->redirectToRoute('genero_index');
        
        
    }
}