<?php

namespace LinkR\Bundle\UserBundle\Model;

use LinkR\Bundle\UserBundle\Model\om\BaseMissionOrder;
use LinkR\Bundle\TaskBundle\Workflow\TaskTargetInterface;

class MissionOrder extends BaseMissionOrder
{
    /**
     * calculate and returns date interval between now and mission begin date
     * (end if mission is over)
     *
     * @return DateInterval
     */
    public function getDuration()
    {
        $begin = $this->getBeginDate();
        $end   = $this->getEndDate();

        $ref   = empty($end) ? new \DateTime() : $end;

        return $begin->diff($ref);
    }

}
