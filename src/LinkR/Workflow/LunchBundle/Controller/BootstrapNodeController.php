<?php

namespace LinkR\Workflow\LunchBundle\Controller;

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
        return $this->get('lunch.bootstrap.handler');
    }

    /**
     * {@inherit_doc}
     */
    protected function getTemplates()
    {
        return array(
            'node'             => 'LinkRWorkflowLunchBundle::node.html.twig',
            'modal'            => 'LinkRWorkflowLunchBundle:Bootstrap:modal.html.twig',
            'notification'     => 'LinkRWorkflowLunchBundle:Bootstrap:notification.html.twig',
            'timeline_element' => 'LinkRWorkflowLunchBundle:Bootstrap:timeline_element.html.twig'
        );
    }

    /**
     * {@inherit_doc}
     */
    protected function executeNode(Request $request, Task $task, $template)
    {
        $form = $this->get('lunch.bootstrap.form');

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
