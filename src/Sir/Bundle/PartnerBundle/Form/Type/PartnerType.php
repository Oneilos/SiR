<?php

namespace Sir\Bundle\PartnerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Form type for Partner entity.
 */
class PartnerType extends AbstractType
{
    /**
     * @see FormInterface::getName()
     */
    public function getName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'SirSdk\Component\Partner\Model\Partner',
            'csrf_protection'    => false,
            'allow_extra_fields' => true,
        ]);
    }

    /**
     * @see FormInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // *************************************************
        //
        // Class auto generated by MajoraGeneratorBundle
        // Implement your own logic here !
        //
        // *************************************************
    }
}