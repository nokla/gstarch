<?php

namespace App\Http\Controllers;

use App\Models\ArchDoc;
use App\Models\Archive;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\UserAffect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function PHPUnit\Framework\directoryExists;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->id;
        $prf = Auth::user()->profil;
        $aff = UserAffect::where('iUser', $user)->first();
        if ($prf==1) {
            $cri = Departement::all();
            $arc = Archive::orderBy('id', 'ASC')->get();
        }
        else{
            $cri = Departement::find($aff->iDiv);
            $arc = Archive::where('vid', $aff->iDiv)
                            ->orderBy('id', 'ASC')->get();
        }
        //$arc = ArchDoc::orderBy('iSrc', 'ASC')->get();
       // dd($arc);
        if ($aff->iNiv==3) {
            $niv = GetSrv($aff->iServ);
            $idy = $aff->iServ;
        } else {
            $niv =GetDiv($aff->iDiv);
            $idy = $aff->iDiv;
        }

        //dd($niv);
        return view('home', [
            'archives' => $arc,
            'niv' => $aff->iNiv,
            'sdiv' => $niv,
            'idy' => $idy
        ]);
    }
    public function PubArch()
    {
        //$cri = Departement::all();
        $cri = Departement::all();
        /* $arr =[];
        foreach ($cri as $key => $value) {
            $arr[] = Departement::find($value->id)->Services()->get();
        }
        dd($arr); */
        return view('layouts.cri', [
            'cri' => $cri
        ]);
    }
}
