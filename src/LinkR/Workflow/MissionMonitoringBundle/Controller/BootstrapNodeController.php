<?php

namespace LinkR\Workflow\MissionMonitoringBundle\Controller;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Workflow\TypeNodeController;

use EasyTask\Bundle\WorkflowBundle\Model\Workflow;

use Symfony\Component\HttpFoundation\Request;

/**
 * bootstrap workflow node controller
 * @see LinkR\Bundle\TaskBundle\Workflow\TypeNodeController
 */
class BootstrapNodeController extends TypeNodeController
{
    /**
     * {@inherit_doc}
     */
    public function getHandler()
    {
        return $this->get('mission_monitoring.bootstrap.handler');
    }

    /**
     * {@inherit_doc}
     */
    protected function getTemplates()
    {
        return array(
            'node'             => 'LinkRWorkflowMissionMonitoringBundle::node.html.twig',
            'modal'            => 'LinkRWorkflowMissionMonitoringBundle:Bootstrap:modal.html.twig',
            'notification'     => 'LinkRWorkflowMissionMonitoringBundle:Bootstrap:notification.html.twig',
            'timeline_element' => 'LinkRWorkflowMissionMonitoringBundle:Bootstrap:timeline_element.html.twig'
        );
    }

    /**
     * {@inherit_doc}
     */
    protected function executeNode(Request $request, Task $task, $template)
    {
        $form = $this->get('mission_monitoring.bootstrap.form');

        if ($request->request->has($form->getName())                    // submited form
            && $this->getHandler()->handle($form, $request, $task)      // successful handled
            ) {
            return $this->redirectOrDefault('Rhea_homepage');
        }

        return $this->render($template, $this->addTaskParams($task, array(
            'type_dir' => 'Bootstrap',
            'task'     => $task,
            'form'     => $form->createView()
        )));
    }
}
