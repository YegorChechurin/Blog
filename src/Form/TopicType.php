<?php

namespace App\Form;

use App\Entity\Topic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\TopicRepository;

class TopicType extends AbstractType
{
    private $repo;

    public function __construct(TopicRepository $repo)
    {
        $this->repo = $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $topics = $this->repo->findAll();

        $choices[] = null;
        foreach ($topics as $t) {
            $choices[] = $t;
        }

        $builder
            ->add('name')
            ->add('parent_topic', ChoiceType::class,
                     [
                        'choices' => $choices,
                        'choice_label' => function(?Topic $topic) {
                            if ($topic) {
                                return $topic->getName();
                            } else {
                                return '';
                            }
                        }
                     ]
                 )
            ->add('save', SubmitType::class, ['label' => 'Save Topic to Database']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Topic::class,
        ]);
    }
}
