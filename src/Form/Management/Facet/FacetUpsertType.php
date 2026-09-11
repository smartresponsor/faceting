<?php

declare(strict_types=1);

namespace App\Faceting\Form\Management\Facet;

use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Defines the Symfony management form used to validate facet upsert input.
 */
final class FacetUpsertType extends AbstractType
{
    /**
     * Adds the supported facet definition fields and preview submit action to the form.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class)
            ->add('nameEntity', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Term' => 'term',
                    'Range' => 'range',
                    'Boolean' => 'boolean',
                    'Hierarchy' => 'hierarchy',
                ],
            ])
            ->add('visible', CheckboxType::class, ['required' => false])
            ->add('submit', SubmitType::class, ['label' => 'Preview facet']);
    }

    /**
     * Binds submitted form data to the canonical typed facet upsert DTO.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FacetUpsertDTO::class,
        ]);
    }
}
