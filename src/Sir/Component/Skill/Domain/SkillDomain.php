<?php

namespace Sir\Component\Skill\Domain;

class SkillDomain
{
    public function create(Skill $skill)
    {
        $skill->setFullname(sprintf('%s %s',
            ucwords(strtolower($skill->getFirstName())),
            $skill->getLastName()
        ));
    }

    public function update(Skill $skill)
    {

    }

    public function delete(Skill $skill)
    {

    }
}
