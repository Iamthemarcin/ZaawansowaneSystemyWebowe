<?php


namespace App\Factory;


use App\DTO\Form\ProjectEditDTO;
use App\Entity\Project\ProjectEntity;

class ProjectFactory
{
    public function createFromEditProject(ProjectEntity $entity): ProjectEditDTO
    {
        $project = new ProjectEditDTO();
        $project->setMinuteTest($entity->getMinuteTest());
        $project->setSpeedTest($entity->getSpeedTest());
        $project->setUpdateTest($entity->getUpdateTest());

        return $project;
    }
}