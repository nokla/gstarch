<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchDoc extends Model
{
    use HasFactory;

    public function Arch(): BelongsTo
    {
        return $this->belongsTo(Archive::class,'idArch');
    }

    /* public function Docs(): BelongsTo
    {
        return $this->belongsTo(Document::class,'iArch', 'idDoc');
    } */
    public function Docs():HasMany
    {
        return $this->hasMany(Document::class,'iArch');
    }
}
