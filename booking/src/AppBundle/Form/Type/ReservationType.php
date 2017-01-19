<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use AppBundle\Form\Model\Reservation;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accomodation', NumberType::class, [
                'invalid_message' => 'Id smjestaja mora biti broj'
            ])
            ->add('startDate', DateType::class, [
                'required' => true,
                'label' => false,
            ])
            ->add('endDate', DateType::class, [
                'required' => true,
                'label' => false,
            ])
       ;
    }
}
