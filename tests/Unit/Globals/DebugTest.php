<?php

declare(strict_types=1);

test('Global debug functions should not be used')
    ->expect(['dd', 'dump', 'print', 'print_r', 'var_dump', 'ds', 'ray'])
    ->not->toBeUsed();

test('Every file should declare strict types')
    ->expect('App')
    ->toUseStrictTypes();
