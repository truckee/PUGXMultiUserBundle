<?php

/*
 * This file is part of the Truckee\Match package.
 * 
 * (c) George W. Brooks
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Truckee\MatchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Count;

class OpportunityType extends AbstractType
{
    private $skills;

    public function __construct($skills = null)
    {
        $this->skills = $skills;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('active', 'checkbox', array(
                    'label' => 'Active',
                ))
                ->add('oppName', 'text', array(
                    'label' => 'Name',
                    'attr' => array(
                        'size' => 40,
                        'placeholder' => 'Name',
                    ),
                    'label_attr' => array(
                        'class' => 'sr-only',
                    ),
                ))
                ->add('description', 'textarea', array(
                    'label' => 'Description',
                    'attr' => array(
                        'placeholder' => 'Description',
                        'cols' => '60',
                        'rows' => '2',
                    ),
                    'label_attr' => array(
                        'class' => 'sr-only',
                    ),
                ))
                ->add('minage', 'choice', array(
                    'choices' => array(
                        '' => 'Minimum age',
                        '5' => '5',
                        '12' => '12',
                        '18' => '18',
                        '21' => '21',
                        '55' => '55',
                    ),
                    'label' => 'Minimum age: ',
                    'attr' => array(
                        'placeholder' => 'Minimum age',
                    ),
                    'label_attr' => array(
                        'class' => 'sr-only',
                    ),
                ))
                ->add('groupOk', 'checkbox', array(
                    'label' => 'Group OK',
                ))
                ->add('expireDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'M/d/y',
                    'label' => 'Expiration date: ',
                    'attr' => array(
                        'placeholder' => 'Expiration date (m/d/y)',
                    ),
                    'label_attr' => array(
                        'class' => 'sr-only',
                    ),
                ))
                ->add('save', 'submit', array(
                    'label' => 'Save opportunity',
                    'attr' => array(
                        'class' => 'btn-xs',
                    ),
                ))
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
            $form = $event->getForm();
            if (true === $this->skills) {
                $form->add('skills', 'skills', array(
                    'constraints' => array(
                        new Count(array('min' => '1', 'minMessage' => 'At least one skill is required')),
                    ),
                ));
            }
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Truckee\MatchBundle\Entity\Opportunity',
            'required' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'opportunity';
    }
}
