<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Form\Model\Address;

class AddressType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('street', TextType::class, ['required' => true, 'label' => 'Ulica'])
        	->add('postCode', NumberType::class, ['required' => true, 'label' => 'Poštanski broj'])
            ->add('place', TextType::class,['required' => true, 'label' => 'Mjesto'])
            ->add('county', TextType::class,['required' => true, 'label' => 'Država'])
       ;
    }

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => Address::class,
	    ));
	}
}