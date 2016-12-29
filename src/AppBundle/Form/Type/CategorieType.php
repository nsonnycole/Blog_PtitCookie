<?php namespace AppBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Categorie;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                                    'label' => 'Catégorie',
                                    'attr' => array('placeholder' => 'Nom de la catégorie...')))
            ->add('Ajouter', SubmitType::class);
    }
}
