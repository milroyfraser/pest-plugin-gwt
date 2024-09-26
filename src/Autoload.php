<?php

declare(strict_types=1);

namespace Pest\Gwt;

function scenario(string $description): BehaviorDescriptor
{
    return new BehaviorDescriptor($description);
}
