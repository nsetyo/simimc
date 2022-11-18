<?php

declare(strict_types=1);

namespace App\Enums;

enum Categories: string
{
    case BINPROF_BAHAN_AJAR       = 'binprof::bahan-ajar';
    case BINPROF_DATA_PERSONEL    = 'binprof::data-personel';
    case IMC_LAP_ANALISIS_MEDIA   = 'imc::lap-analisis-media';
    case INTELUD_ADO              = 'intelud::ado';
    case INTELUD_DATA_KUAT_UDARA  = 'intelud::data-kuat-udara';
    case INTELUD_FSC              = 'intelud::fsc';
    case LITPERS_HASIL_MI         = 'litpers::hasil-mi';
    case LITPERS_SC_MITRA         = 'litpers::sc-mitra';
    case LITPERS_SKHPP            = 'litpers::skhpp';
    case PAMSUT_CATPERS           = 'pamsut::catpers';
    case PRODINT_BUKU_PETUNJUK    = 'prodint::buku-petunjuk';
    case PRODINT_LAP_NON_PERIODIK = 'prodint::lap-non-periodik';
    case PRODINT_LAP_PERIODIK     = 'prodint::lap-periodik';

    public function label(): string
    {
        return match ($this) {
            self::BINPROF_BAHAN_AJAR => $this->parent()->label() . ' :: Bahan Ajar',
            self::BINPROF_DATA_PERSONEL => $this->parent()->label() . ' :: Data Personel',
            self::IMC_LAP_ANALISIS_MEDIA => $this->parent()->label() . ' :: Laporan Analisis Media',
            self::INTELUD_ADO => $this->parent()->label() . ' :: ADO',
            self::INTELUD_DATA_KUAT_UDARA => $this->parent()->label() . ' :: Data Kuat Udara',
            self::INTELUD_FSC => $this->parent()->label() . ' :: FSC',
            self::LITPERS_HASIL_MI => $this->parent()->label() . ' :: Hasil MI',
            self::LITPERS_SC_MITRA => $this->parent()->label() . ' :: SC Mitra',
            self::LITPERS_SKHPP => $this->parent()->label() . ' :: SKHPP',
            self::PAMSUT_CATPERS => $this->parent()->label() . ' :: Catpers',
            self::PRODINT_BUKU_PETUNJUK => $this->parent()->label() . ' :: Buku Petunjuk',
            self::PRODINT_LAP_NON_PERIODIK => $this->parent()->label() . ' :: Laporan Non Periodik',
            self::PRODINT_LAP_PERIODIK => $this->parent()->label() . ' :: Laporan Periodik',
        };
    }

    public function parent(): MainCategory
    {
        return match ($this) {
            self::BINPROF_BAHAN_AJAR,
            self::BINPROF_DATA_PERSONEL => MainCategory::BINPROF,
            self::IMC_LAP_ANALISIS_MEDIA => MainCategory::IMC,
            self::INTELUD_ADO,
            self::INTELUD_DATA_KUAT_UDARA,
            self::INTELUD_FSC => MainCategory::INTELUD,
            self::LITPERS_HASIL_MI,
            self::LITPERS_SC_MITRA,
            self::LITPERS_SKHPP => MainCategory::LITPERS,
            self::PAMSUT_CATPERS => MainCategory::PAMSUT,
            self::PRODINT_BUKU_PETUNJUK,
            self::PRODINT_LAP_PERIODIK,
            self::PRODINT_LAP_NON_PERIODIK => MainCategory::PRODINT
        };
    }
}
