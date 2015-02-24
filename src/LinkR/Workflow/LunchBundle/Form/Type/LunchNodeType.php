<?php

namespace LinkR\Workflow\LunchBundle\Form\Type;

use LinkR\Bundle\TaskBundle\Form\Type\AbstractNodeType;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * form type for lunch node
 * @see LinkR/Workflow/LunchBundle/Resources/workflows/lunch.xml
 */
class LunchNodeType extends AbstractNodeType
{
    /**
     * {@inherit_doc}
     */
    public function getName()
    {
        return 'lunch_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }
}
