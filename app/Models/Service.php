<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    // yallah khdm
    public function Departement()
    {
        return $this->belongsTo(Departement::class, 'division');
    }


    /* $d = Departement::first();
    foreach($d->Services as $item){
        $item->sName; // service name 
        // $item howa objet dial service 
    } */
}
