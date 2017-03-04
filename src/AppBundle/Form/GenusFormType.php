<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\SubFamilyRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class GenusFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $bilder, array $options)
	{
		$bilder
			->add('name')
			->add('subFamily', EntityType::class, array(
				'class'        => 'AppBundle:SubFamily',
				'placeholder'  => 'Choose a Sub Family',
				'query_builder' => function(SubFamilyRepository $repo	) {
					   return $repo->createAlphabeticallQueryBuilder();
				}
			))
			->add('speciesCount')
			->add('funFact')
			->add('isPublished', ChoiceType::class, array(
			    'choices' => array(
			    	'Yes' => true,
			    	'No'  => false
			    )
			))
			->add('firstDiscoveredAt', DateTimeType::class, array(
                'widget' => 'single_text',
			    'attr'   => ['class' => 'js-datepicker'],
			    'html5'  => false
			))
		;
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'AppBundle\Entity\Genus'
		]);
	}
}