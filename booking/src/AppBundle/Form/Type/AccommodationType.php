<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Form\Model\Accommodation;

class AccommodationType extends AbstractType
{
	private $entityManager;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            ])
            ->add('pricePerDay', NumberType::class, [
            	'invalid_message' => 'Cijena mora biti broj'
            ])
            ->add('category', ChoiceType::class, [
            	'choices'  => [
            		'1 zvijezdica' => 1,
            		'2 zvijezdice' => 2,
            		'3 zvijezdice' => 3,
            		'4 zvijezdice' => 4,
            		'5 zvijezdica' => 5,
            	],
            	'expanded' => false,
            	'multiple' => false,
			])
			->add('place', ChoiceType::class, [
            	'choices'  => $this->getPlaceChoices(),
            	'expanded' => false,
            	'multiple' => false,
			])
       ;
    }

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	    	'method' => 'post',
	        'data_class' => Accommodation::class,
	        'csrf_protection' => true,
	    ));
	}

	private function getPlaceChoices()
	{
		$allPlaces = $this->entityManager->getRepository('AppBundle:Place')->findAll();
		$placeChoices = [];
		foreach($allPlaces as $place)
			$placeChoices[$place->getName()] = $place->getName();
		return $placeChoices;
	}
}