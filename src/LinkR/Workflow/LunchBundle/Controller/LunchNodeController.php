<?php

namespace LinkR\Workflow\LunchBundle\Controller;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Workflow\TypeNodeController;
use LinkR\Bundle\MissionBundle\Model\MissionQuery;

use EasyTask\Bundle\WorkflowBundle\Model\Workflow;

use Symfony\Component\HttpFoundation\Request;

/**
 * bootstrap workflow node controller
 * @see LinkR\Bundle\TaskBundle\Workflow\TypeNodeController
 */
class LunchNodeController extends TypeNodeController
{
    /**
     * {@inherit_doc}
     */
    public function getHandler()
    {
        return $this->get('lunch.lunch.handler');
    }

    /**
     * {@inherit_doc}
     */
    protected function getTemplates()
    {
        return array(
            'node'             => 'LinkRWorkflowLunchBundle::node.html.twig',
            'modal'            => 'LinkRWorkflowLunchBundle:Lunch:modal.html.twig',
            'notification'     => 'LinkRWorkflowLunchBundle:Lunch:notification.html.twig',
            'timeline_element' => 'LinkRWorkflowLunchBundle:Lunch:timeline_element.html.twig'
        );
    }

    /**
     * use hook method to adds prev task data into new
     *
     * {@inherit_doc}
     */
    protected function onTaskCreation(Task $nextTask, Task $prevTask = null, array $parameters = array(), \Pdo $connection = null)
    {
        $lunchTaskDomain = $this->get('lunch.domain.lunch_task');
        $taskTargets = $prevTask->getTaskTargets();

        // We recalculate lunch targets
        $mission = $lunchTaskDomain->getLunchTargetedMission($taskTargets, $connection);
        $nextTask = $lunchTaskDomain->calculateLunchTargets($mission, $nextTask, $connection);

        // activation
        $this->get('LinkR_task.domain.task')->activateTaskOn(
            $nextTask,
            $prevTask->data()->get('meeting_date'),
            '+1 day'
        );

        $nextTask->data()->set('meeting_date', $prevTask->data()->get('meeting_date'));
        $nextTask->data()->set('meeting_place', $prevTask->data()->get('meeting_place'));

        return parent::onTaskCreation($nextTask, $prevTask, $parameters, $connection);
    }

    /**
     * {@inherit_doc}
     */
    protected function executeNode(Request $request, Task $task, $template)
    {
        $form = $this->get('lunch.lunch.form');

        if ($request->request->has($form->getName())                    // submited form
            && $this->getHandler()->handle($form, $request, $task)      // successful handled
            ) {
            return $this->redirectOrDefault('Rhea_homepage');
        }

        return $this->render($template, $this->addTaskParams($task, array(
            'type_dir' => 'Lunch',
            'task'     => $task,
            'form'     => $form->createView()
        )));
    }
}
