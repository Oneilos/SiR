<?php

namespace LinkR\Bundle\MissionBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * form type for mission forms
 *
 * @see LinkR/Bundles/MissionBundle/Resources/config/admin.xml
 */
class MissionEditType extends MissionType
{
    /**
     * @see AbstracType::getName()
     */
    public function getName()
    {
        return 'mission_edit_form';
    }

    /**
     * @see AbstracType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return $resolver->setDefaults(array (
            'data_class' => 'LinkR\Bundle\MissionBundle\Model\Mission'
        ));
    }

    /**
     * @see AbstracType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('client', 'client_form', array(
            'required' => true,
            'label'    => false
        ));
    }
}
