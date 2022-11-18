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
            self::BINPROF_BAHAN_AJAR => 'BinProf :: Bahan Ajar',
            self::BINPROF_DATA_PERSONEL => 'BinProf :: Data Personel',
            self::IMC_LAP_ANALISIS_MEDIA => 'IMC :: Laporan Analisis Media',
            self::INTELUD_ADO => 'Intelud :: ADO',
            self::INTELUD_DATA_KUAT_UDARA => 'Intelud :: Data Kuat Udara',
            self::INTELUD_FSC => 'Intelud :: FSC',
            self::LITPERS_HASIL_MI => 'Litpers :: Hasil MI',
            self::LITPERS_SC_MITRA => 'Litpers :: SC Mitra',
            self::LITPERS_SKHPP => 'Litpers :: SKHPP',
            self::PAMSUT_CATPERS => 'Pamsut :: Catpers',
            self::PRODINT_BUKU_PETUNJUK => 'Prodint :: Buku Petunjuk',
            self::PRODINT_LAP_NON_PERIODIK => 'Prodint :: Laporan Non Periodik',
            self::PRODINT_LAP_PERIODIK => 'Prodint :: Laporan Periodik',
        };
    }
}
