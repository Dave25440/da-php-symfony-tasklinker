<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Task;
use App\Enum\TaskStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la tâche',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
            ])
            ->add('deadline', DateType::class, [
                'label' => 'Date',
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => array_combine(
                    array_map(fn($case) => $case->getLabel(), TaskStatus::cases()),
                    array_map(fn($case) => $case->value, TaskStatus::cases())
                ),
            ])
            ->add('employee', EntityType::class, [
                'label' => 'Membre',
                'class' => Employee::class,
                'choice_label' => function (Employee $employee) {
                    return $employee->getFirstname() . ' ' . $employee->getLastname();
                },
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
