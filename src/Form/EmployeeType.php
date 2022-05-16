<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\Employee;
use App\Entity\EmployeeCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('employee_code')
            ->add('employee_name')
            ->add('employee_surname')
            ->add('employee_sexe')
            ->add('employee_dob', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('employee_email')
            ->add('employee_photo', FileType::class, [
                'label' => 'Photo (PNG, JPEG, PDF)',
                'multiple' => false,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('employee_phone')
            ->add('hire_date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('employee_adress')
            ->add('employee_status')
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'expanded' => true,
                'multiple' => true,
                'choice_label' => function ($role) {
                    return $role->getAllRoles();
                }
            ])
            ->add('kpa', EntityType::class, [
                'label' => 'Zone de performance',
                'attr' => ['class' => 'form-control'],
                'class' => EmployeeCategory::class,
                'choice_label' => function ($zone) {
                    return $zone->getName();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
