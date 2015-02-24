<?php

namespace LinkR\Workflow\AnnualReviewBundle\Controller;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\TaskBundle\Workflow\TypeNodeController;

use EasyTask\Bundle\WorkflowBundle\Model\Workflow;

use Symfony\Component\HttpFoundation\Request;

/**
 * preparing workflow node controller
 * @see LinkR\Bundle\TaskBundle\Workflow\TypeNodeController
 */
class PreparingNodeController extends TypeNodeController
{
    /**
     * {@inherit_doc}
     */
    public function getHandler()
    {
        return $this->get('annual_review.preparing.handler');
    }

    /**
     * {@inherit_doc}
     */
    protected function getTemplates()
    {
        return array(
            'node'             => 'LinkRWorkflowAnnualReviewBundle::node.html.twig',
            'modal'            => 'LinkRWorkflowAnnualReviewBundle:Preparing:modal.html.twig',
            'notification'     => 'LinkRWorkflowAnnualReviewBundle:Preparing:notification.html.twig',
            'timeline_element' => 'LinkRWorkflowAnnualReviewBundle:Preparing:timeline_element.html.twig'
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

        // re assign to crh if we can
        if ($prevTask->data()->has('crh_id')) {
            $nextTask->setAssignedTo($prevTask->data()->get('crh_id'));
        }

        $meetingDate = $prevTask->data()->get('meeting_date');
        $nextTask->data()->set('meeting_date', $meetingDate);

        // activation
        $this->get('LinkR_task.domain.task')->activateTaskOn(
            $nextTask,
            $this->get('LinkR_task.tools.temporal')->changeDate($meetingDate, '-1 month'),
            '+21 days'
        );

        return parent::onTaskCreation($nextTask, $prevTask, $parameters, $connection);
    }

    /**
     * {@inherit_doc}
     */
    public function onTaskDiffering(Task $task)
    {
        $this->get('LinkR_task.domain.task')->activateTaskFor(
            $task, '+21 days'
        );
    }

    /**
     * {@inherit_doc}
     */
    protected function executeNode(Request $request, Task $task, $template)
    {
        $data = array(   // default values
            'manager_id'   => $task->getTarget('consultant')->getManager()->getId(),
            'meeting_date' => $task->data()->get('meeting_date')
        );

        $options = array(  // form options
            'document_directory'  => $task->getTarget('consultant')->getUrl(),
            'document_name_model' => $this->get('translator')->trans(
                'annual_review_preparing.document.name', array(), 'messages', $this->container->getParameter('locale')
            )
        );

        $form = $this->get('form.factory')->create('annual_review_preparing_form', $data, $options);

        if ($request->request->has($form->getName())                    // submited form
            && $this->getHandler()->handle($form, $request, $task)      // successful handled
            ) {
            return $this->redirectOrDefault('Rhea_homepage');
        }

        return $this->render($template, $this->addTaskParams($task, array(
            'type_dir' => 'Preparing',
            'task'     => $task,
            'form'     => $form->createView()
        )));
    }
}
