<?php

namespace App\Form;

use App\Entity\Tasks;
use App\Entity\Customers;
use App\Entity\Departments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TasksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descriptions',
            ])
            ->add('price')
            ->add('start_date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('end_date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('status', TextType::class, [
                'label' => 'Statut',
            ])
            ->add('department_id', EntityType::class, [
                'class' => Departments::class,
                'expanded' => true,
                'multiple' => true,
                'label' => 'Departements',
                'choice_label' => function ($depts) {
                    return $depts->getDepartmentName();
                }
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Client',
                'attr' => ['class' => 'form-control'],
                'class' => Customers::class,
                'choice_label' => function ($chef) {
                    return $chef->getFullName();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tasks::class,
        ]);
    }
}
