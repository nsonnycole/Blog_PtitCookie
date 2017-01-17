<?php namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Categorie;

class ArticleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('titre', TextType::class)
    ->add('description', TextareaType::class)
    ->add('contenu', TextareaType::class, array(
            'attr' => array(
            'class' => 'tinymce',
            'data-theme' => 'bbcode' // Skip it if you want to use default theme
        )
    ))

    ->add('difficulte', ChoiceType::class, [
      'choices' => [
        'Facile' => "Facile",
        'Moyen' => "Moyen",
        'Difficile' => "Difficile",
      ],
      'expanded' => true // Radio boutons au lieu de select
    ])

    ->add('image', TextType::class)
    ->add('categorie', EntityType::class, array(
      'class' => 'AppBundle:Categorie',
      'label' => 'Catégorie',
      'choice_label' => 'nom',
      'multiple' => false,
      'placeholder' => 'Choisir une catégorie...',
      'required' => true))
    ->add('tags', EntityType::class, array(
        'class' => 'AppBundle:Tag',
        'label' => 'Tag',
        'multiple' => true,
        'expanded' => true,
        'choice_label' => 'nom',
      ));
    }
  }
