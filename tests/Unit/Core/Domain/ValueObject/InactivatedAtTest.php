<?php

declare(strict_types=1);

use App\Core\Domain\ValueObject\InactivatedAt;
use App\Core\Exception\ValueObjectException;

test('Deve retornar true quando validar uma data valida')
    ->expect(InactivatedAt::validate(new DateTimeImmutable()))->toBeTrue();

test('Deve retornar false quando validar uma data invalida')
    ->expect(InactivatedAt::validate('2021-13-01'))->toBeFalse()
    ->and(InactivatedAt::validate('2021-12-32'))->toBeFalse()
    ->and(InactivatedAt::validate('2021-12-01 25:00:00'))->toBeFalse()
    ->and(InactivatedAt::validate('2021-12-01 23:60:00'))->toBeFalse()
    ->and(InactivatedAt::validate('2021-12-01 24:00:99'))->toBeFalse()
    ->and(InactivatedAt::validate('2021-12-01 222:00:00.0000000'))->toBeFalse();

test('Deve retornar uma nova instancia quando o valor informado for valido')
    ->expect(InactivatedAt::create(new DateTimeImmutable()))->toBeInstanceOf(InactivatedAt::class)
    ->and(InactivatedAt::create())->toBeInstanceOf(InactivatedAt::class);

test('Deve lancar uma exception quando o valor informado for invalido ao tentar criar uma instancia')
    ->throws(ValueObjectException::class)
    ->expect(fn () => InactivatedAt::create('2025-13-01'));

test('Deve retornar uma instanica DeletedAt quando informado o valor nulo')
    ->expect(InactivatedAt::create())->toBeInstanceOf(InactivatedAt::class)
    ->and(InactivatedAt::create()->getValue())->toBeNull();

test('Deve retornar true quando isActive ter o valor informado como null')
    ->expect(InactivatedAt::create()->isActive())->toBeTrue();

test('Deve retornar false quando isActive ter o valor informado diferente de null')
    ->expect(InactivatedAt::create(new DateTimeImmutable())->isActive())->toBeFalse();

test('Deve retornar true quando isInactive ter o valor informado diferente de null')
    ->expect(InactivatedAt::create(new DateTimeImmutable())->isInactive())->toBeTrue();

test('Deve retornar false quando isInactive ter o valor informado como null')
    ->expect(InactivatedAt::create()->isInactive())->toBeFalse();

test('Deve retornar a instancia com a data atual quando chamar inactivate')
    ->expect(InactivatedAt::create(null)->inactivate())->toBeInstanceOf(InactivatedAt::class)
    ->and(InactivatedAt::create(null)->inactivate()->getValue())->toBeInstanceOf(DateTimeImmutable::class);

test('Deve retornar a instancia com o valor nulo quando chamar reactivate')
    ->expect(InactivatedAt::create(new DateTimeImmutable())->reactivate())->toBeInstanceOf(InactivatedAt::class)
    ->and(InactivatedAt::create(new DateTimeImmutable())->reactivate()->getValue())->toBeNull();

test('Deve retornar a data formatada quando chamado o metodo __toString')
    ->expect((string) InactivatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00')))->toBe('2021-12-01T00:00:00-03:00');

test('Deve retornar a data formatada no formato ISO8601')
    ->expect(InactivatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00'))->toISO8601())->toBe('2021-12-01T00:00:00-03:00');

test('Deve retornar a data formatada no formato informado')
    ->expect(InactivatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00'))->format('d/m/Y'))->toBe('01/12/2021');

test('Deve retornar a data armazenada')
    ->expect(InactivatedAt::create(new DateTimeImmutable('2021-12-01 00:00:00'))->getValue())->toBeInstanceOf(DateTimeImmutable::class);

test('Deve retornar a data formatada quando chamado o metodo __toString com valor nulo')
    ->expect((string) InactivatedAt::create())->toBe('active');

test('Deve retornar a data formatada no formato ISO8601 com valor nulo')
    ->expect(InactivatedAt::create()->toISO8601())->toBeNull();

test('Deve retornar a data formatada no formato informado com valor nulo')
    ->expect(InactivatedAt::create()->format('d/m/Y'))->toBeNull();

test('Deve retornar a data armazenada com valor nulo')
    ->expect(InactivatedAt::create()->getValue())->toBeNull();
