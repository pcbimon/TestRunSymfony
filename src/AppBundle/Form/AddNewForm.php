<?php
namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddNewForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Username', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Password', TextType::class, array('attr' => array('class' => 'form-control')))
            // ->add('role', ChoiceType::class, array(
            //   'choice_label' => function($role, $key, $index) {
            //         /** @var Role $role */
            //         return $role->getName();
            //     },
            // ));
            // ->add('save', SubmitType::class, array('label' => 'Edit User','attr' => array('class' => 'btn btn-block btn-primary')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
