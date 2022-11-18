<?php

declare(strict_types=1);

namespace App\Enums;

enum MainCategory: string
{
    case BINPROF = 'binprof';
    case IMC     = 'imc';
    case INTELUD = 'intelud';
    case LITPERS = 'litpers';
    case PAMSUT  = 'pamsut';
    case PRODINT = 'prodint';

    public function label(): string
    {
        return match ($this) {
            self::BINPROF => 'BinProf',
            self::IMC => 'IMC',
            self::INTELUD => 'Intelud',
            self::LITPERS => 'Litpers',
            self::PAMSUT => 'Pamsut',
            self::PRODINT => 'Prodint',
        };
    }
}
