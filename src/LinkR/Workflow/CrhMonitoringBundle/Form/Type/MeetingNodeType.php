<?php

namespace LinkR\Workflow\CrhMonitoringBundle\Form\Type;

use LinkR\Bundle\TaskBundle\Form\Type\AbstractNodeType;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * form type for meeting node
 * @see LinkR/Workflow/CrhMonitoringBundle/Resources/workflows/meeting.xml
 */
class MeetingNodeType extends AbstractNodeType
{
    /**
     * {@inherit_doc}
     */
    public function getName()
    {
        return 'meeting_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            $builder->create('crh_meeting_doc', 'document', array(
                    'required'     => true,
                    'button_label' => 'crh_monitoring.meeting.form.doc_label_button',
                    'label'        => 'crh_monitoring.meeting.crh_meeting_doc'
                ))
                ->addModelTransformer($this->createDocumentTransformer($options))
        );
    }
}
