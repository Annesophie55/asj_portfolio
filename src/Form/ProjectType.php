<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\technology;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('link')
            ->add('img', FileType::class, [
                'label' => 'Image du projet (Fichier image)',
                'mapped' => false,
                'required' => false,
            ])
            ->add('Technologies', EntityType::class, [
                'class' => Technology::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true, 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
