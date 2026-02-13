<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('picture', TextType::class, [
                'label' => 'Image URL (or leave empty to upload)',
                'required' => false,
                'help' => 'Enter a full image URL (starting with http:// or https://) or a filename from /uploads/',
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Or Upload Image (JPG, PNG)',
                'mapped' => false,
                'required' => false,
                'help' => 'Upload an image file to replace any URL above',
                'constraints' => [
                    new File(
                        maxSize: '5M',
                        mimeTypes: [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        mimeTypesMessage: 'Veuillez télécharger une image valide (JPG, PNG, GIF)',
                    )
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
