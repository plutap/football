<?php

namespace Gajdaw\FootballBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('home')
            ->add('away')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gajdaw\FootballBundle\Entity\Game'
        ));
    }

    public function getName()
    {
        return 'gajdaw_footballbundle_gametype';
    }
}
