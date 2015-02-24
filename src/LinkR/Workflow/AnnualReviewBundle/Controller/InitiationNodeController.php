<?php

namespace LinkR\Workflow\AnnualReviewBundle\Controller;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Workflow\TypeNodeController;

use EasyTask\Bundle\WorkflowBundle\Model\Workflow;

use Symfony\Component\HttpFoundation\Request;

/**
 * initiation workflow node controller
 * @see LinkR\Bundle\TaskBundle\Workflow\TypeNodeController
 */
class InitiationNodeController extends TypeNodeController
{
    /**
     * {@inherit_doc}
     */
    public function getHandler()
    {
        return $this->get('annual_review.initiation.handler');
    }

    /**
     * {@inherit_doc}
     */
    protected function getTemplates()
    {
        return array(
            'node'             => 'LinkRWorkflowAnnualReviewBundle::node.html.twig',
            'modal'            => 'LinkRWorkflowAnnualReviewBundle:Initiation:modal.html.twig',
            'notification'     => 'LinkRWorkflowAnnualReviewBundle:Initiation:notification.html.twig',
            'timeline_element' => 'LinkRWorkflowAnnualReviewBundle:Initiation:timeline_element.html.twig'
        );
    }

    /**
     * {@inherit_doc}
     */
    protected function executeNode(Request $request, Task $task, $template)
    {
        $form = $this->get('annual_review.initiation.form');

        if ($request->request->has($form->getName())                    // submited form
            && $this->getHandler()->handle($form, $request, $task)      // successful handled
            ) {
            return $this->redirectOrDefault('Rhea_homepage');
        }

        return $this->render($template, $this->addTaskParams($task, array(
            'type_dir' => 'Initiation',
            'task'     => $task,
            'form'     => $form->createView()
        )));
    }
}
