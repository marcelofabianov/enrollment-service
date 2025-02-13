<?php

declare(strict_types=1);

use App\Core\Domain\Exception\ValueObjectException;
use App\Core\Domain\ValueObject\CreatedAt;

test('Deve retornar true quando validar uma data valida')
    ->expect(CreatedAt::validate(new DateTimeImmutable()))->toBeTrue();

test('Deve retornar false quando validar uma data invalida')
    ->expect(CreatedAt::validate('2021-13-01'))->toBeFalse()
    ->and(CreatedAt::validate('2021-12-32'))->toBeFalse()
    ->and(CreatedAt::validate('2021-12-01 25:00:00'))->toBeFalse()
    ->and(CreatedAt::validate('2021-12-01 23:60:00'))->toBeFalse()
    ->and(CreatedAt::validate('2021-12-01 24:00:99'))->toBeFalse()
    ->and(CreatedAt::validate('2021-12-01 222:00:00.0000000'))->toBeFalse();

test('Deve retornar uma nova instancia quando o valor informado for valido')
    ->expect(CreatedAt::create(new DateTimeImmutable()))->toBeInstanceOf(CreatedAt::class);

test('Deve lancar uma exception quando o valor informado for invalido ao tentar criar uma instancia')
    ->throws(ValueObjectException::class)
    ->expect(fn () => CreatedAt::create('2025-13-01'));

test('Deve retornar uma nova instancia com a data atual quando o valor informado for nulo')
    ->expect(CreatedAt::create(null)->getValue())->toBeInstanceOf(DateTimeImmutable::class);

test('Deve retornar a data formatada quando chamado o metodo __toString')
    ->expect((string) CreatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00')))->toBe('2021-12-01T00:00:00-03:00');

test('Deve retornar a data formatada no formato ISO8601')
    ->expect(CreatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00'))->toISO8601())->toBe('2021-12-01T00:00:00-03:00');

test('Deve retornar a data formatada no formato informado')
    ->expect(CreatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00'))->format('d/m/Y'))->toBe('01/12/2021');

test('Deve retornar a data armazenada')
    ->expect(CreatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00'))->getValue())->toBeInstanceOf(DateTimeImmutable::class);

test('Deve retornar uma nova instancia com a data atual')
    ->expect(CreatedAt::now())->toBeInstanceOf(CreatedAt::class);
