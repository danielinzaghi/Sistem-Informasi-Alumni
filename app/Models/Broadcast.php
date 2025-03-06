<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'api_id',
        'detail',
        'message',
        'target',
    ];
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
}