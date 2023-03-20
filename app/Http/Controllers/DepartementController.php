<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Bureau;
use App\Models\Departement;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class DepartementController extends Controller
{
    //new
    public function addnew(){
        $div = Departement::all();
        /* foreach ($div as $key => $value) {
            $secr = Str::random(16);
            $token =  $value->code.':'.hash('sha256', $secr);
            $mjr = Departement::find($value->id);
            $mjr->token = $token;
            $mjr->save();
        } */
            //dd($token);
        $serv = Service::all();
        $bur = Bureau::all();

        return view('cri.add', [
            'divs' => $div,
            'sers' => $serv,
            'bur' => $bur
        ]);
    }

    //save the new
    public function savedep(Request $request){
        $type = $request->tp;
        //dd($request->all());

        if ($type ==1) {
            //$words = preg_split("/\s+/", $request->depart);
            $words = explode(" ", $request->depart);
            $acronym = "";
            foreach ($words as $w) {
                if (Str::length($w)>3) {
                    $acronym .= Str::upper(mb_substr($w, 0, 1));
                }

            }
            $code = $acronym;
            $secr = Str::random(16);
            $token = $code.':'.hash('sha256', $secr);
            $dep = new Departement();
                $dep->division = $request->depart;
                $dep->code = $code;
                $dep->token = $token;
            $dep->save();

        }
        if ($type==2) {
            $words = explode(" ", $request->serv);
            $acronym = "";
            foreach ($words as $w) {
                if (Str::length($w)>3) {
                    $acronym .= Str::upper(mb_substr($w, 0, 1));
                }

            }
            $code = $acronym;
            $serv = new Service();
                $serv->division = $request->divs;
                $serv->service = $request->serv;
                $serv->code = $code;
            $serv->save();
        }

        return redirect()->route('cri.new')->with('status','that is good');
    }

    //get services
    public function GetServs(Request $request)
    {
        $div = $request->vl;
        $psd = $request->psd;
        $serv = Service::where('division', $div)->get();
        $doss = Archive::whereIn('vid', function($query) use($div) {
            $query->select('id')->from('services')->where('division', $div);
            })
            ->where('sTyp', 3)
            ->get();
        if ($div==-1) {
            $dpat = 'CRI/';
            $path = Storage::path('CRI/');
        } else {
            $dpat = GetDiv($div);
            if (!Storage::exists('CRI/'.$dpat)) {
                 Storage::makeDirectory('CRI/'.$dpat);
             }
             $path = Storage::path('CRI/'.$dpat);
        }

        //$options = $this->buildFolderOptions($path);
        $html = '<option value="-1">Choisir</option>';

        foreach ($serv  as $value) {
            //$html .= '<option value="'.$value['value'].'">'.$value['label'].'</option>';
            $html .= '<option value="'.$value->id.'">'.$value->service.'</option>';
        }
        /* foreach ($doss  as $value) {
            //$html .= '<option value="'.$value['value'].'">'.$value['label'].'</option>';
            $html .= '<option value="d'.$value->id.'">'.$value->sNom.'</option>';
        } */


        return response($html);
    }
    /* public function GetDossOld(Request $request )
    {

        $vl = $request->input('vl');
        //$parts = preg_split('/\d+/', $vl);
        $typ = $vl[0];
        $val = substr($vl, 1);

        if($typ=='s'){
            $serv = Service::find($val);
            $div = Departement::find($serv->division);
            $path = 'CRI/'.$div->code.'/'.$serv->code;
        }
        if ($typ=='d') {
            $arch = Archive::where('id', $val)->get();
            $path =$arch->sPath;
        }
        //$pa = storage_path($path);
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
        $options = $this->buildFolderOptions(Storage::path($path));
        //dd($options);


        $html = '<option value="-1">Choisir</option>';
        if (!empty($options)) {
            foreach ($options  as $value) {
                $html .= '<option value="'.$value['value'].'">'.$value['label'].'</option>';
                //html .= '<option value="'.$value->id.'">'.$value->service.'</option>';
            }
        }
        return response($html);
    } */
    public function GetDoss(Request $request )
    {

        $vl = $request->input('vl');
        $srv = Service::find($vl);
        $token = hash('sha256', $srv->code);
        $doss = Archive::where('sTyp', 3)->where('sToken', $token)->get();
        //dd($doss);

        $html = '<option value="-1">Choisir</option>';
        if (!empty($doss)) {
            foreach ($doss  as $value) {
                $html .= '<option value="'.$value['id'].'">'.$value['sNom'].'</option>';
                //html .= '<option value="'.$value->id.'">'.$value->service.'</option>';
            }
        }
        return response($html);
    }
    // Recursive function to build the folder options
}
