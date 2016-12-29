<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\Model\User;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['required' => false, 'label' => 'Ime'])
            ->add('lastname', TextType::class)
            ->add('age', NumberType::class)
            ->add('gender', ChoiceType::class, [
                 'choices'  => array(
                    'Man' => 'man',
                    'Woman' => 'woman',
                ),
                'expanded' => true,
                'multiple' => false
            ])
            ->add('doner', CheckboxType::class)
            ->add('addressHome', AddressType::class, ['label' => 'Adresa Doma'])
            ->add('addressWork', AddressType::class, ['label' => 'Adresa Posao'])
            ->add('phones', CollectionType::class, [
                'entry_type' => NumberType::class
            ])

       ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => ['tekst'],
            'method' => 'post',
            'data_class' => User::class,
            'csrf_protection' => true,
        ));
    }
}
