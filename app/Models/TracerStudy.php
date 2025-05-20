<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TracerStudy extends Model
{
    use HasFactory;

    protected $table = 'tracer_study';

    protected $fillable = [
        'alumni_id', 'status_saat_ini'
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id');
    }

    public function bekerja()
    {
        return $this->hasOne(Bekerja::class);
    }

    public function pendidikanLanjut()
    {
        return $this->hasOne(PendidikanLanjut::class);
    }

    public function wirausaha()
    {
        return $this->hasOne(Wirausaha::class);
    }

    public function pencarianKerja()
    {
        return $this->hasOne(PencarianKerja::class);
    }

    public function belumBekerja()
    {
        return $this->hasOne(BelumBekerja::class);
    }

    public function sudahLengkap()
    {
        return $this->status_saat_ini && (
            $this->status_saat_ini === 'Bekerja' && $this->bekerja
            || $this->status_saat_ini === 'Wiraswasta' && $this->wirausaha
            || $this->status_saat_ini === 'Melanjutkan Pendidikan' && $this->pendidikanLanjut
            || $this->status_saat_ini === 'Mencari kerja' && $this->pencarianKerja
            || $this->status_saat_ini === 'Belum bekerja' && $this->belumBekerja
        );
    }


}
