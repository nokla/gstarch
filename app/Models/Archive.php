<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Archive extends Model
{
    use HasFactory;
    protected $fillable = [
        'sTyp',
        'sNiv',
        'vid',
        'sToken',
        'sNom',
        'iby'
    ];

    /* public function ArchDocs(): HasMany
    {
        return $this->hasMany(ArchDoc::class,'idArch');
    } */
    public function Docs() : HasMany
    {
        return $this->hasMany(Document::class, 'iArch', 'id');
    }
}
