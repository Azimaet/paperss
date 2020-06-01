<?php

namespace App\Form;

use App\Entity\Source;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class SourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, [
                'default_protocol' => 'https',
                'required' => false,
                'attr' => [
                    'placeholder' => 'https://domain.com/subdomain.xml',
                ]
            ])
            ->add('filterLimitItems', RangeType::class, [
                'required' => true,
                'attr' => [
                    'min' => 0, 
                    'max' => 100
                ]
            ])
            ->add('filterMustContain', TextType::class, [
                'required' => false,
            ])
            ->add('filterMustExclude', TextType::class, [
                'required' => false,
            ])
        ;

        $builder
            ->get('filterMustContain')
            ->addModelTransformer(new CallbackTransformer(
                function($filterMustContainArray){

                    if (is_null($filterMustContainArray)){
                        $filterMustContainArray = [];
                    }
                    // Transform the Array to a String:
                    return implode(', ', $filterMustContainArray);
                },
                function ($filterMustContainString){
                    // Transform the string back to an array:
                    return explode(', ', $filterMustContainString);
                }
            ))
        ;

        $builder
        ->get('filterMustExclude')
        ->addModelTransformer(new CallbackTransformer(
            function($filterMustExludeArray){

                if (is_null($filterMustExludeArray)){
                    $filterMustExludeArray = [];
                }
                // Transform the Array to a String:
                return implode(', ', $filterMustExludeArray);
            },
            function ($filterMustExcludeString){
                // Transform the string back to an array:
                return explode(', ', $filterMustExcludeString);
            }
        ))
    ;   
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Source::class,
        ]);
    }
}
