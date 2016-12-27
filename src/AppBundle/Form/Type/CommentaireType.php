<?php namespace BlogBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\EntityRepository;
use BlogBundle\Entity\Comment;
class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auteur', TextType::class, array(
                                    'label' => 'Pseudo',
                                    'attr' => array('placeholder' => 'Entrer un pseudo...')))
            ->add('commentaire', TextareaType::class, array('label' => 'Votre commentaire...'))
            ->add('Ajouter', SubmitType::class);
    }
}
