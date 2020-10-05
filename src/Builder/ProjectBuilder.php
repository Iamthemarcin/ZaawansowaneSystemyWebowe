<?php


namespace App\Builder;


use App\DTO\Form\ProjectAddDTO;
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
}