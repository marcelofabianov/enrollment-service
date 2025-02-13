<?php

declare(strict_types=1);

use App\Core\Contract\Domain\ValueObject\Version as VersionContract;
use App\Core\Domain\ValueObject\Version;
use App\Core\Exception\ValueObjectException;

test('Deve retornar true quando validar um valor maior ou igual a 1')
    ->expect(Version::validate(1))->toBeTrue();

test('Deve retornar false quando validar um valor menor que 1')
    ->expect(Version::validate(0))->toBeFalse()
    ->and(Version::validate(-1))->toBeFalse();

test('Deve retornar uma nova instancia quando o valor informado for valido')
    ->expect(Version::create(1))->toBeInstanceOf(Version::class)
    ->and(Version::create(2))->toBeInstanceOf(VersionContract::class);

test('Deve retornar uma nova instancia com valor 1 quando o valor informado for nulo')
    ->expect(Version::create(null)->getValue())->toBe(1);

test('Deve lancar uma exception quando o valor informado for invalido ao tentar criar uma instancia')
    ->throws(ValueObjectException::class)
    ->expect(fn () => Version::create(0));

test('Deve retornar true quando comparado duas versoes iguais')
    ->expect(Version::create(1)->equals(Version::create(1)))->toBeTrue();

test('Deve retornar false quando comparado duas versoes diferentes')
    ->expect(Version::create(1)->equals(Version::create(2)))->toBeFalse();

test('Deve retornar o valor da versao quando chamado o metodo __toString')
    ->expect((string) Version::create(1))->toBe('1')
    ->and((Version::create(2))->__toString())->toBe('2');

test('Deve retornar o valor da versao armazenado')
    ->expect(Version::create(1)->getValue())->toBe(1);

test('Deve retornar uma nova instancia quando o valor informado for uma instancia de VersionInterface')
    ->expect(Version::create(Version::create(1)))->toBeInstanceOf(Version::class);
