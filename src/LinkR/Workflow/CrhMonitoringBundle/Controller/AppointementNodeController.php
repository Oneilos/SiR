<?php

namespace LinkR\Workflow\CrhMonitoringBundle\Controller;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Workflow\TypeNodeController;

use EasyTask\Bundle\WorkflowBundle\Model\Workflow;

use Symfony\Component\HttpFoundation\Request;

/**
 * appointement workflow node controller
 * @see LinkR\Bundle\TaskBundle\Workflow\TypeNodeController
 */
class AppointementNodeController extends TypeNodeController
{
    /**
     * {@inherit_doc}
     */
    public function getHandler()
    {
        return $this->get('crh_monitoring.appointement.handler');
    }

    /**
     * {@inherit_doc}
     */
    protected function getTemplates()
    {
        return array(
            'node'             => 'LinkRWorkflowCrhMonitoringBundle::node.html.twig',
            'modal'            => 'LinkRWorkflowCrhMonitoringBundle:Appointement:modal.html.twig',
            'notification'     => 'LinkRWorkflowCrhMonitoringBundle:Appointement:notification.html.twig',
            'timeline_element' => 'LinkRWorkflowCrhMonitoringBundle:Appointement:timeline_element.html.twig'
        );
    }

    /**
     * use hook method to adds prev task data into new
     *
     * {@inherit_doc}
     */
    protected function onTaskCreation(Task $nextTask, Task $prevTask = null, array $parameters = array(), \Pdo $connection = null)
    {
        $nextTask->migrateTargets($prevTask);

        // activation
        $this->get('LinkR_task.domain.task')->activateTaskOn(
            $nextTask,
            $prevTask->data()->get('notif_date'),
            '+1 day'
        );

        $nextTask->data()->set('meeting_date', $prevTask->data()->get('next_meeting_date'));

        return parent::onTaskCreation($nextTask, $prevTask, $parameters, $connection);
    }

    /**
     * {@inherit_doc}
     */
    protected function executeNode(Request $request, Task $task, $template)
    {
        $form  = $this->get('crh_monitoring.appointement.form')->setData(array(
            'meeting_date' => $task->data()->get('meeting_date')
        ));

        if ($request->request->has($form->getName())                    // submited form
            && $this->getHandler()->handle($form, $request, $task)      // successful handled
            ) {
            return $this->redirectOrDefault('Rhea_homepage');
        }

        return $this->render($template, $this->addTaskParams($task, array(
            'type_dir' => 'Appointement',
            'task'     => $task,
            'form'     => $form->createView()
        )));
    }
}
