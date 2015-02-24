<?php

namespace LinkR\Workflow\LunchBundle\Domain;

use LinkR\Bundle\TaskBundle\Model\Task;
use LinkR\Bundle\MissionBundle\Model\Mission;
use LinkR\Bundle\MissionBundle\Model\MissionQuery;
use LinkR\Bundle\UserBundle\Model\ConsultantQuery;

/**
 * LunchTask domain, repository of lunch task logic
 *
 * @see LinkRUserBundle/Resources/config/domains.xml
 */
class LunchTaskDomain {

    /**
     * Get mission of specific lunch, a lunch is composed of
     * one mission and n consultants as targets
     *
     * @param PropelObjectCollection $taskTargets
     * @return Mission
     */
    public function getLunchTargetedMission(\PropelObjectCollection $taskTargets, \Pdo $pdo = null)
    {
        $mission = MissionQuery::create();
        $missionClass = $mission->getModelName();

        foreach ($taskTargets as $taskTarget)
        {
            if ($taskTarget->getTargetModel() == $missionClass)
            {
                $missionTargetId = $taskTarget->getTargetId();
            }
        }
        $mission = $mission
            ->setComment(sprintf('%s l:%s', __METHOD__, __LINE__))
            ->findOneById($missionTargetId, $pdo);

        return $mission;
    }

    /**
     * calculate lunch targets, one mission and n consultants
     *
     * @param Mission $mission mission of lunch task
     * @param Task $task
     * @return Task
     */
    public function calculateLunchTargets(Mission $mission, Task $task, \Pdo $pdo = null)
    {
        $consultants = ConsultantQuery::create()
            ->setComment(sprintf('%s l:%s', __METHOD__, __LINE__))
            ->useMissionOrderQuery()
                ->filterByCurrent(true)
                ->filterByMission($mission)
            ->endUse()
            ->find($pdo);

        // Insert of task targets
        $task->addTarget($mission);
        foreach ($consultants as $consultant)
        {
            $task->addTarget($consultant);
        }
        return $task;
    }

}
