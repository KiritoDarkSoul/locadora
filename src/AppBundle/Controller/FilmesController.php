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
     *@Route("/filmes/filtrar/{filtro}", name="filmes_filtrar") 
     */
    public function filtrarAction($filtro)
    {
        $filmes = $this->getEm()->getRepository('AppBundle:Filmes');
        
        if ($filtro == 'lancamento')
        {
            $retorno = $filmes->findBy(
                    array('lancamento' => true)
                    );
        }else
        {
            $retorno = $filmes->findAll();
        }
        
        
        
        /*View*/
        return $this->render('filmes/index.html.twig', 
                array('filmes' => $retorno)
        );
    }
    
    
    /**
     * @Route("/filmes/deletar/{id}", name="filmes_deletar")
     */
    public function deletarAction($id)
    {
        $repositorio = $this->getEm()->getRepository('AppBundle:Filmes');
        $filme = $repositorio->find($id);
        
        $this->getEm()->remove($filme);
        
        $this->getEm()->flush();
        
        $this->addFlash('info', 'Filme deletado com sucesso');
        
        return $this->redirectToRoute("filmes_index");
    }
    
    /**
     * @Route("/filmes/editar/{id}", name="filmes_editar")
     */
    public function filmesEditarAction(Request $request, $id)
    {
        $repositorio = $this->getEm()->getRepository('AppBundle:Filmes');
        
        /**
         * @var \AppBundle\Entity\
         */
        $filme = $repositorio->find($id);
        $capa = $filme-> getNomeCapa();
        
        $form = $this->createForm(FilmesType::class, $filme);
        $form->handleRequest($request);
        
         if ($form->isSubmitted() && $form->isValid())
        {
            $pasta = __DIR__.'/../../../web/capas';
            $imagem = $form['capa']->getData();
            $ext = $imagem->guessExtension();
            
            $nomeArquivo = uniqid().'.'.$ext;
            
            $imagem->move($pasta, $nomeArquivo);
            
            $filme->setCapa($nomeArquivo);
            
            $doctrine = $this->getEm();
            $doctrine->persist($filme);
            $doctrine->flush();
            
            $this->addFlash('cadastro', 'O filme foi cadastrado com sucesso');
            
            return $this->redirectToRoute('filmes_index');
        }
        
        return $this->render('filmes/cadastro.html.twig', array(
           'form_filmes'=> $form->createView(),
            'capa' => $capa
                          
      ));
    }
    /**
     * 
     */
    public function cadastroAction(Request $request)
    {
        $filme = new Filmes();
        $form =  $this->createForm(FilmesType::class, $filme);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            return $this->;
    }

    /**
     * 
     * @param type $filme
     * @param type $request
     * @return type
     */
    private function formSubmit($filme, $request)
     {
   
            $pasta = __DIR__.'/../../../web/capas';
            $imagem = $form['capa']->getData();
            $ext = $imagem->guessExtension();
            
            $nomeArquivo = uniqid().'.'.$ext;
            
            $imagem->move($pasta, $nomeArquivo);
            
            $filme->setCapa($nomeArquivo);
            
            $doctrine = $this->getEm();
            $doctrine->persist($filme);
            $doctrine->flush();
            
            $this->addFlash('cadastro', 'O filme foi cadastrado com sucesso');
            
            return $this->redirectToRoute('filmes_index');
        }
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
            $pasta = __DIR__.'/../../../web/capas';
            $imagem = $form['capa']->getData();
            $ext = $imagem->guessExtension();
            
            $nomeArquivo = uniqid().'.'.$ext;
            
            $imagem->move($pasta, $nomeArquivo);
            
            $filme->setCapa($nomeArquivo);
            
            $doctrine = $this->getEm();
            $doctrine->persist($filme);
            $doctrine->flush();
            
            $this->addFlash('cadastro', 'O filme foi cadastrado com sucesso');
            
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