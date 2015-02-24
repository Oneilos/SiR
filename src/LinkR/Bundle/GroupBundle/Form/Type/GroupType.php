<?php

namespace LinkR\Bundle\GroupBundle\Form\Type;

use LinkR\Bundle\GroupBundle\Form\DataTransformer\GroupCredentialsDataTransformer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Form type for groups
 * @see LinkRGroupBundle/Resources/config/services.xml
 */
class GroupType extends AbstractType
{
    /**
     * {@inherit_doc}
     */
    public function getName()
    {
        return 'group_form';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return $resolver->setDefaults(array(
            'data_class' => 'LinkR\Bundle\GroupBundle\Model\Group',
            'group_id'   => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // group label
        $builder->add('label', 'text', array(
            'required' => true
        ));

        // credentials throught transformer
        $builder->add(
            $builder->create('GroupCredentials', 'credentials_form')
                ->addModelTransformer(new GroupCredentialsDataTransformer($options['group_id']))
        );
    }
}
