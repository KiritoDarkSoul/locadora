<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use \Symfony\Bridge\Doctrine\Form\Type\EntityType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use  \Symfony\Component\Form\Extension\Core\Type\FileType;
use \Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class FilmesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('nome')
                ->add('genero', EntityType::class, array(
                    'class' => 'AppBundle:Genero',
                    
       
                ))
                ->add('lancamento', ChoiceType::class, array(
                    'choices' => array('não' => false, 'sim' =>true),
                    'expanded' => true,
                    'multiple' =>false,
                    'data'=> false
                    
                ))
                ->add('sinopse',TextareaType::class, array(
                    'required' => false
                ))
                ->add('data', BirthdayType::class)
                ->add('capa', FileType::class, array(
                    'required' => false
                ));
    }
    
    public function configureOptions(OptionsResolver $resolver) 
    {
        $resolver->setDefaults(array(
           'data_class' => 'appBundle\Entity\Filmes', 
        ));
    }

}
