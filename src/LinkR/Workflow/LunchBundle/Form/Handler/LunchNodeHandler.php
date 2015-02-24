<?php

namespace LinkR\Workflow\LunchBundle\Form\Handler;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Form\Handler\AbstractNodeHandler;

use Symfony\Component\Form\Form;

/**
 * form handler for lunch node
 * @see LinkR/Workflow/LunchBundle/Resources/workflows/lunch.xml
 */
class LunchNodeHandler extends AbstractNodeHandler
{
    /**
     * {@inherit_doc}
     */
    public function resolve(array $data, Task $task, \Pdo $pdo = null)
    {
        $nextLunchTmstp = $this->temporalTools->changeDate(
            $task->getActivationDate(), '+2 months', 'U'
        );

        $task->data()->set('next_meeting_date',
            $this->temporalTools->findNextWorkingDay($nextLunchTmstp)
        );

        $task->data()->set('notif_date', $this->temporalTools->findNextWorkingDay(
            $this->temporalTools->changeDate($nextLunchTmstp, '-7 days', 'U'))
        );

        $task->save($pdo);

        // notify next node
        return $this->notifyNext('appointement', $task, array(), $pdo);
    }
}
