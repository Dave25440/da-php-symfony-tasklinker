<?php

namespace App\Story;

use App\Factory\EmployeeFactory;
use App\Factory\ProjectFactory;
use App\Factory\TaskFactory;
use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;

#[AsFixture(name: 'main')]
final class AppStory extends Story
{
    public function build(): void
    {
        ProjectFactory::createMany(2);
        EmployeeFactory::createMany(3);
        TaskFactory::createMany(8);
    }
}
