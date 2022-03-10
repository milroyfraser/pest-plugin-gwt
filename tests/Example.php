<?php

use function Pest\Gwt\scenario;
use function PHPUnit\Framework\assertEquals;

scenario('given and when returning nothing')
    ->given(function () {})
    ->when(function () {})
    ->then(function () { assertEquals(1, 1); });

scenario('given and when returning non array values')
    ->given(function () {
        return 5;
    })
    ->when(function (int $number) {
        return $number * 10;
    })
    ->then(function (int $answer) {
        assertEquals(50, $answer);
    });

scenario('given and when returning arrays')
    ->given(function () {
        return [5];
    })
    ->when(function (int $number) {
        return [$number * 10];
    })
    ->then(function (int $answer) {
        assertEquals(50, $answer);
    });

scenario('writing testes without given')
    ->when(function () {
        return [5 * 10];
    })
    ->then(function (int $answer) {
        assertEquals(50, $answer);
    });

scenario('expecting exception')
    ->when(function () {
        throw new Exception('Woops!');
    })
    ->throws(Exception::class, 'Woops!');

scenario('expecting exception without message')
    ->when(function () {
        throw new Exception('Woops!');
    })
    ->throws(Exception::class);
