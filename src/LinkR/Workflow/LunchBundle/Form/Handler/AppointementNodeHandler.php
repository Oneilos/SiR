<?php

namespace LinkR\Workflow\LunchBundle\Form\Handler;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Form\Handler\AbstractNodeHandler;

use Symfony\Component\Form\Form;

/**
 * form handler for appointement node
 * @see LinkR/Workflow/LunchBundle/Resources/workflows/appointement.xml
 */
class AppointementNodeHandler extends AbstractNodeHandler
{
    /**
     * {@inherit_doc}
     */
    public function resolve(array $data, Task $task, \Pdo $pdo = null)
    {
        // activate before given date for pre-notification
        $task->data()->set('meeting_date',
            $this->temporalTools->findNextWorkingDay($data['meeting_date'], 'U')
        );

        $task->data()->set('meeting_place', $data['meeting_place']);

        $task->save($pdo);

        // notify next node
        return $this->notifyNext('lunch', $task, array(), $pdo);
    }
}
