<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($options['action'])
                ->add('nom',TextType::class,array(
                    'required'=>'true',
                ))
                ->add('prenom',TextType::class,array(
                'required'=>'true',
                  ))
                ->add('age',IntegerType::class,array(
                    'attr' => array('min' => 1 )
                ))
                ->add('emploi',EntityType::class,array(
                    'class'=>'AppBundle\Entity\Emploi',
                        'choice_label'=>'State',
                        'multiple'=>'true',
                        'required'=>'true',
                        'expanded'=>'true'
                )
                )
                ->add('addresse',EntityType::class,array(
                    'class'=>'AppBundle\Entity\Adresse',
                    'choice_label'=>'Description',
                    'required'=>'true',
                ))
                 ->add('image',FileType::class,array(
                'label'=>'Photo'
                ))
                ->add('Envoyer',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Personne'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_personne';
    }


}
