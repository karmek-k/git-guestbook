<?php

namespace App\Form;

use App\Entity\Guestbook;
use Beelab\Recaptcha2Bundle\Form\Type\RecaptchaType;
use Beelab\Recaptcha2Bundle\Validator\Constraints\Recaptcha2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestbookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('color', TextType::class, [
                'label' => 'Guestbook widget color (hex value)',
                'attr' => [
                    'maxlength' => 6,
                    'minlength' => 3,
                ],
            ])
            ->add('confirmEntries', CheckboxType::class, [
                'required' => false,
                'label' => 'Do entries require confirmation?',
            ])
            ->add('captcha', RecaptchaType::class, [
                'constraints' => new Recaptcha2(),
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Guestbook::class,
        ]);
    }
}
