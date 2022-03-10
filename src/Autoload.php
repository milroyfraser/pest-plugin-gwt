<?php

declare(strict_types=1);

namespace Pest\Gwt;

/**
 * @return BehaviorDescriptor
 */
function scenario(string $description)
{
    return new BehaviorDescriptor($description);
}
