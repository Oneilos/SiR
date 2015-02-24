<?php

namespace LinkR\Workflow\LunchBundle\Form\Handler;

use LinkR\Bundle\TaskBundle\Model\om\BaseTaskTargetQuery;
use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Model\TaskTarget;
use LinkR\Bundle\TaskBundle\Form\Handler\AbstractNodeHandler;
use Symfony\Component\Form\Form;
use LinkR\Bundle\MissionBundle\Model\MissionQuery;
use LinkR\Workflow\LunchBundle\Domain\LunchTaskDomain;

/**
 * form handler for bootstrap node
 * @see LinkR/Workflow/LunchBundle/Resources/workflows/bootstrap.xml
 */
class BootstrapNodeHandler extends AbstractNodeHandler
{

    protected $lunchTaskDomain;

    public function __construct(LunchTaskDomain $lunchTaskDomain)
    {
        $this->lunchTaskDomain = $lunchTaskDomain;
    }

    /**
     * {@inherit_doc}
     */
    public function resolve(array $data, Task $task, \Pdo $pdo = null)
    {
        // activate before given date for pre-notification
        $task->data()->set('next_meeting_date', $data['next_date']);
        $task->data()->set('notif_date',
            $this->temporalTools->findNextWorkingDay(
                $this->temporalTools->changeDate($data['next_date'], '-7 days'), 'U'
            )
        );

        // updates workflow fields
        $this->updateWorkflow($data, $task, $pdo);

        // calculate task targets
        $mission = MissionQuery::create()->findOneById($data['mission_target_id']);
        $task = $this->lunchTaskDomain->calculateLunchTargets($mission, $task, $pdo);
        $task->save($pdo);

        // notify next node
        return $this->notifyNext('appointement', $task, array(), $pdo);
    }
}
