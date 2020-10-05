<?php


namespace App\Builder;


use App\DTO\Form\ProjectAddDTO;
use App\Entity\Project\Project;

class ProjectBuilder
{
    public function createFromDTO(ProjectAddDTO $dto): Project
    {
        $project = new Project();
        $project->setStatus($dto->isStatus());
        $project->setDomain($dto->getDomain());

        return $project;
    }
}