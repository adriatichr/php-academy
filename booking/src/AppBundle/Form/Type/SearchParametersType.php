<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Form\Model\SearchParameters;

class SearchParametersType extends AbstractType
{

	private $entityManager;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('priceFrom', NumberType::class, [
            	'required' => false, 
            	'label' => false,
            	'invalid_message' => 'Cijena Od mora biti broj'
            ])
            ->add('priceTo', NumberType::class, [
            	'required' => false, 
            	'label' => false,
            	'invalid_message' => 'Cijena Do mora biti broj'
            ])
            ->add('place', ChoiceType::class, [
            	'choices'  => $this->getPlaceChoices(),
            	'expanded' => false,
            	'multiple' => false,
            	'required' => false,
            	'label' => false
			])
       ;
    }

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	    	'method' => 'get',
	        'data_class' => SearchParameters::class,
	        'csrf_protection' => false,
	    ));
	}

	private function getPlaceChoices()
	{
		$allPlaces = $this->entityManager->getRepository('AppBundle:Place')->findAll();
		$placeChoices = [];
		foreach($allPlaces as $place)
			$placeChoices[$place->getName()] = $place->getId();
		return $placeChoices;
	}
}