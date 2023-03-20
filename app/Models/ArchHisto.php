<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchHisto extends Model
{
    use HasFactory;

    public $fillable = ['isVld', 'sAction', 'iType', 'iArch', 'iBy'];

    public function Doc() :BelongsTo
    {
        return $this->belongsTo(Document::class,'id', 'iArch');
    }

    public function Doss():BelongsTo
    {
        return $this->belongsTo(Archive::class, 'id', 'iArch');
    }
}
