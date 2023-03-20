<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;
    public $fillable = ['isVld'];
    /* public function ArchDoc(): BelongsTo
    {
        return $this->belongsTo(ArchDoc::class, 'iArch');
    } */
    public function Archive(): BelongsTo
    {
        return $this->belongsTo(Archive::class, 'iArch');

    }

}
