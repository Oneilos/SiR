<?php

namespace LinkR\Bundle\AgencyBundle\Controller;

use EasyTask\Bundle\WorkflowBundle\Model\WorkflowNode;
use LinkR\Bundle\UserBundle\Model\MissionOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LinkR\Bundle\UserBundle\Model\Internal;
use LinkR\Bundle\TaskBundle\Model\Task;

use LinkR\Bundle\UserBundle\Model\ConsultantQuery;
use EasyTask\Bundle\WorkflowBundle\Model\WorkflowNodeQuery;
use LinkR\Bundle\UserBundle\Model\InternalQuery;
use LinkR\Bundle\TaskBundle\Model\TaskQuery;
use LinkR\Bundle\UserBundle\Model\MissionOrderQuery;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AgencyTaskController extends Controller
{

    /**
     * returns team user ids
     * @return array
     */
    public function getAgencyInternalsId($internalAgencyId)
    {
        $agencyIdCollection = InternalQuery::create()
            ->setComment(sprintf('%s l:%s', __METHOD__, __LINE__))
            ->select(array('Id'))
            ->filterByAgencyId($internalAgencyId)
            ->find();
        return $agencyIdCollection;
    }

    /**
    * list agency past tasks for given user
    *
    * @param Request  $request
    * @param Internal $internal
    *
    * @return Response
    */

    //Recuperer les id de tout les internes de l'agence puis chopper toutes leurs tasks

    public function agencyLateTasksAction(Request $request, $internalAgencyId)
    {
        $taskCollection = TaskQuery::create()
            ->setComment(sprintf('%s l:%s', __METHOD__, __LINE__))
            ->joinWith('Comment', \Criteria::LEFT_JOIN)
            ->joinWithCurrentNodes()

            ->filterByAssignedTo($this->getAgencyInternalsId($internalAgencyId)->getData())
            ->filterByWorkflowTypes(array_keys($this->get('workflows')->getAllowed('read')))

            ->filterByCompletionDate(array('max' => 'now'))

            ->orderByActivationDate()
            ->findWithTargets();

        return $this->render('LinkRAgencyBundle:Dashboard:agency_late_tasks.html.twig', array (
            'tasks' => $taskCollection
        ));
    }

    public function agencyPastTasksAction(Request $request, $internalAgencyId)
    {

        $taskCollection = WorkflowNodeQuery::create()
            ->setComment(sprintf('%s l:%s', __METHOD__, __LINE__))
            ->joinWith('Task', \Criteria::INNER_JOIN)
            ->useTaskQuery()
                ->filterByAssignedTo($this->getAgencyInternalsId($internalAgencyId)->getData())
            ->endUse()
            ->filterByCompletedAt(NULL, \Criteria::ISNOTNULL)

            ->find();
//        var_dump(($taskCollection[0]->getTasks()[0]->getUserAssigned()));die;
        return $this->render('LinkRAgencyBundle:Dashboard:agency_past_tasks.html.twig', array (
            'tasks' => $taskCollection
        ));

    }
}
