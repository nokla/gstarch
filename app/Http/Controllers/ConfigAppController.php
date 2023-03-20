<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use App\Models\Archive;
use App\Models\Service;
use App\Models\User;
use App\Models\UserAffect;
use Illuminate\Support\Facades\Storage;


class ConfigAppController extends Controller
{
    public function GenArchs()
    {
        $divs = Departement::all();

        $item = [];
        foreach ($divs as $key => $value) {
            $path = 'CRI/'.$value->code;
            $item[] = [
                'sTyp' => 1,
                'sNiv' => 1,
                'vid' => $value->id,
                'sToken' => hash('sha256', $value->code),
                'sNom' => $value->code,
                'sPath' => 'CRI/'.$value->code,
                'iby' => Auth::user()->id
            ];
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }

        }
        Archive::insert($item);

        dd($item);
    }

    //Gen Services
    public function GenArchServ()
    {
        $divs = Service::all();

        $item = [];
        foreach ($divs as $key => $value) {
            $path = 'CRI/'.GetDiv($value->division)."/".$value->code;
            $item[] = [
                'sTyp' => 1,
                'sNiv' => 2,
                'vid' => $value->division,
                'sToken' => hash('sha256', $value->code),
                'sNom' => $value->code,
                'sPath' => $path,
                'iby' => Auth::user()->id
            ];
            $serv = new Archive();
                $serv->sTyp = 1;
                $serv->sNiv = 2;
                $serv->vid = $value->division;
                $serv->sToken = hash('sha256', $value->code);
                $serv->sNom = $value->code;
                $serv->sPath = $path;
                $serv->iby = Auth::user()->id;
            $serv->save();

            $Arch = $serv->id;
            Service::where('id', $value->id)->update(['iArch'=> $Arch]);

            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            $item[]= $serv;
        }
        //Archive::insert($item);
        dd($item);
    }

    //Gen Affect Users
    public function UserAffect()
    {
        $users = User::all();

        foreach ($users as $key => $value) {
            $affect = new UserAffect();
            $affect->iUser = $value->id;
            $affect->iDiv = 1;
            $affect->iServ = $value->div;
            $affect->save();
        }
        dd($users);
    }
}
