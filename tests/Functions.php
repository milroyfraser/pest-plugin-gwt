<?php

declare(strict_types=1);

use function Pest\Gwt\scenario;
use function PHPUnit\Framework\assertEquals;

scenario('uses plugin')
    ->given(function () {
        return 5;
    })
    ->when(function (int $number) {
        return $number * 10;
    })
    ->then(function (int $answer) {
        assertEquals(50, $answer);
    });
