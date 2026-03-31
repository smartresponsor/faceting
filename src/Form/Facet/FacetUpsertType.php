<?php

declare(strict_types=1);

namespace App\Form\Facet;

use App\Dto\Facet\FacetUpsertRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class FacetUpsertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class)
            ->add('name', TextType::class)
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
}
