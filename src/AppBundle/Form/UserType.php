<?php

namespace AppBundle\Form;

use AppBundle\Repository\RoleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('username',TextType::class)
            ->add('plainPassword',RepeatedType::class,array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('roles',EntityType::class,array(
               'label' => 'Roles',
                'class' => 'AppBundle:Role',
               'multiple' => true,
               'expanded' => true,
                'query_builder' => function(RoleRepository $er) {
                    return $er->getRoles();
                },
               //'query_builder' => function(RoleRepository $er) {
               //    return $er->createQueryBuilder('r')
               //            ->orderBy('r.id','ASC');
               //},
               'choice_label' => 'name',
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
