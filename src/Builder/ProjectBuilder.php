<?php


namespace App\Builder;


use App\DTO\Form\ProjectAddDTO;
use App\DTO\Form\ProjectEditDTO;
use App\Entity\Links;
use App\Entity\Project\ProjectEntity;

class ProjectBuilder
{
    public function createFromDTO(ProjectAddDTO $dto): ProjectEntity
    {
        $project = new ProjectEntity();
        $project->setStatus($dto->isStatus());
        $project->setDomain($dto->getDomain());
        $project->setClient($dto->getClient());
        $project->setType($dto->getType());

        return $project;
    }

    public function createFromEditDTO(ProjectEntity $currentProject, ProjectEditDTO $dto): ProjectEntity
    {
        $currentProject->setDomain($dto->getDomain());
        $currentProject->setMinuteTest($dto->isMinuteTest());
        $currentProject->setDayTest($dto->isDayTest());
        $currentProject->setUpdateTest($dto->isUpdateTest());
        $currentProject->setType($dto->getType());
        $currentProject->setClient($dto->getClient());
        $currentProject->setStatus($dto->isStatus());




        $link = new Links();
        if($dto->getLinks() !== null){
            $link->setLink($dto->getLinks());
            $currentProject->addLink($link);
        }

        return $currentProject;
    }
}