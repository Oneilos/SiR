<?php

namespace LinkR\Workflow\AnnualReviewBundle\Form\Handler;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Form\Handler\AbstractNodeHandler;

use Symfony\Component\Form\Form;

/**
 * form handler for initiation node
 * @see LinkR/Workflow/AnnualReviewBundle/Resources/workflows/initiation.xml
 */
class InitiationNodeHandler extends AbstractNodeHandler
{
    /**
     * {@inherit_doc}
     */
    public function resolve(array $data, Task $task, \Pdo $pdo = null)
    {
        $task->addTarget($this->loadConsultant($data['user_target_id']), $pdo);

        // assignation
        if (!empty($data['assigned_to'])) {
            $task->setAssignedTo($data['assigned_to']);
        }

        // activation @creation
        $this->taskDomain->activateTaskOn(
            $task, date('Y-m-d'), '+1 day'
        );

        // next task activation
        $task->data()->set('meeting_date',
            $this->temporalTools->findNextWorkingDay($data['next_date'], 'U')
        );

        // updates workflow fields
        $this->updateWorkflow($data, $task);

        $task->save($pdo);

        return $this->notifyNext('preparing', $task, array(), $pdo);
    }
}
