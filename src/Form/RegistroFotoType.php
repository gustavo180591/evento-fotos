<?php

namespace App\Form;

use App\Entity\RegistroFoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroFotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombrePersona', TextType::class, ['label' => 'Nombre de la persona'])
            ->add('nombreArchivo', TextType::class, ['label' => 'Nombre del archivo'])
            ->add('formaPago', ChoiceType::class, [
                'choices' => [
                    'Transferencia' => 'transferencia',
                    'Efectivo' => 'efectivo',
                    'No pagado aún' => 'no pagado aún'
                ],
                'label' => 'Forma de pago'
            ])
            ->add('telefono', TextType::class, ['label' => 'Teléfono'])
            ->add('email', EmailType::class, ['label' => 'Email']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RegistroFoto::class,
        ]);
    }
}
