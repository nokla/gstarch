<?php

namespace App\Http\Controllers;

use App\Models\ArchDoc;
use App\Models\ArchHisto;
use App\Models\Archive;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Service;
use App\Models\Category;
use App\Models\Document;
use App\Models\User;
use Carbon\Carbon;
use Faker\Core\Uuid;
use Illuminate\Support\Str;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Illuminate\Filesystem\Filesystem;
use ZipArchive;
use App\Models\UserAffect;


class ArchiveController extends Controller
{
    //Liste
    public function index($id)
    {
        //liste
       //dd(Auth::user()->id);
       $user = Auth::user()->id;
       $prf = Auth::user()->profil;
       $aff = UserAffect::where('iUser', $user)->first();
        if ($prf==3 && $aff->iNiv>=2) {
            if ($aff->iDiv<>$id) {
                return redirect()->route('home');
            }
        }
        $div = Departement::findorfail($id);
        if ($aff->iNiv==3) {
            $serv = Service::where('id', $aff->iServ)->get();
        } else {
            $serv = Service::where('division', $div->id)->get();
        }

        $archive = Archive::where('sTyp', 1)
                            //->where('sNiv', 1)
                            //->orWhere('sTyp', 3)
                            ->where('vid', $div->id)
                            ->first();
                            //->paginate(8);
        $docs = Document::whereHas('Archive', function($query) use($archive){
            $query->where('iArch', $archive->id)->orwherein('iShare', [1, 2, 3]);
        })->paginate(10);
        $doss = Archive::where('sTyp', 3)
                //->where('sNiv', 1)
                ->where('vid', $id)
                ->orwherein('iShare', [1, 2, 3])
                ->paginate(10);
        //dd($serv);
        //$docs = $archive->Docs;
        //$docs = ArchDoc::where('sToken', $div->token)->where('sNiv', '2')->paginate(15);
        $caty = Category::all();
        //dd($docs);
        return view('archive.index', [
            'div' => $div,
            'serv' => $serv,
            'docs' => $docs,
            'cat' => $caty,
            'doss' => $doss,
            'arch' => $archive
        ]);
    }
    //liste service
    public function indexService($id)
    {
        //dd($id);
        $caty = Category::all();
        $serv = Service::findorfail($id);
        $user = Auth::user()->id;
        $prf = Auth::user()->profil;
        $aff = UserAffect::where('iUser', $user)->first();
        if ($prf==3 && $aff->iNiv>=3) {
            if ($aff->iServ<>$id) {
                return redirect()->route('arc.index', ['id'=>$aff->iDiv]);
            }
        }
        $token = hash('sha256', $serv->code);
        $div = Departement::select('division', 'code', 'token')->where('id', $serv->division)->first();
        $archive = Archive::where('sTyp', 2)
                            ->where('sNiv', 2)
                            //->orwhereIn('iShare', [1, 2, 3])
                            ->where('sToken', $token)
                            ->first();
                            //->paginate(8);
        if (!empty($archive)) {
            $docs = Document::whereHas('Archive', function($query) use($archive){
                $query->where('iArch', $archive->id)->orwhereIn('iShare', [1, 2, 3]);
            })->paginate(10);
        } else {
            $docs = [];
        }

        $doss = Archive::where('sTyp', 3)
                ->where('sNiv', 3)
                ->where('sToken', $token)
                ->orwhereIn('iShare', [1, 2, 3])
               // ->tosql();
                ->paginate(10);
        //dd($docs);
        /* $path = Storage::path('CRI/'.GetDiv($serv->division).'/'.$serv->code);
        $directories = File::directories($path);
        $files = File::files($path); */
        return view('archive.service', [
            'div' => $div,
            'serv' => $serv,
            'docs' => $docs,
            'cat' => $caty,
            'doss' => $doss,
            /* 'files' => $files,
            'directories' => $directories,
            'path' => $path */
        ]);
    }

    //New Folder
    public function NewFolder(Request $request)
    {
        $newname = $request->input('nw');
        $src = $request->input('sr');
        $token = $request->input('st');
        $tt = $request->input('tt');
        $dd = $request->input('dd');
        $originalString = $request->je;
        $user = substr($originalString, 2);
        $niv = $request->input('nv');
        $path = '';

        if ($tt=='s') {
            $serv = Service::find($dd);
            $path = 'CRI/'.GetDiv($serv->division)."/".$serv->code."/".$newname;
        }
        if ($tt=='d') {
            $div = Departement::find($dd);
            $path = 'CRI/'.$div->code."/".$newname;
        }
        if ($tt=='f') {
            $arc = Archive::find($dd);
            $path = $arc->sPath."/".$newname;
        }

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }


        $folder = new Archive();
            $folder->sTyp = 3;
            $folder->sNiv = $niv+1;
            $folder->vid = $src;
            $folder->sToken = $token;
            $folder->sNom = $newname;
            $folder->sPath = $path;
            $folder->iShare = 1;
            $folder->iby = $user;
            $folder->isVld = 1;
        $folder->save();

        $folder_id = $folder->id;

        $hist = new ArchHisto();
            $hist->sAction = "Ajout Dossier : ".$newname;
            $hist->iType = 1;
            $hist->iArch = $folder_id;
            $hist->iBy = Auth::user()->id;
        $hist->save();


        return response()->json("Nouveau Dossier créer sous le nom : ".$newname);
    }
    //new folder from upload
    public function NewFolderTwo(Request $request)
    {
        $newname = $request->input('nw');
        $src = $request->input('sr');
        $originalString = $request->input('je');
        $user = substr($originalString, 2);
        $tpath = $request->input('ty');
        $token = '';
        $id = '';
        $niv = 1;
        //get archive
        $arch = Archive::find($src);
        $sTyp = $arch->sTyp;
        $sniv = $arch->sNiv;
        $niv = $sniv+1;
        $id = $arch->id;
        $token = $arch->sToken;

        if (!Storage::exists($tpath)) {
            Storage::makeDirectory($tpath);
        }

        $folder = new Archive();
            $folder->sTyp = 3;
            $folder->sNiv = $niv;
            $folder->vid = $id;
            $folder->sToken = $token;
            $folder->sNom = $newname;
            $folder->sPath = $tpath;
            $folder->iShare = 1;
            $folder->iby = $user;
            $folder->isVld = 1;
        $folder->save();

        $folder_id = $folder->id;


        return response()->json(["vNom" => $newname, "vD" =>$folder_id]);

    }

    //new folder by archive create
    public function ArchMakeDir(Request $request)
    {
        //dd($request->all());
        $pat = $request->pt;
        $newname = $request->nw;
        $check = $request->input('_token');
        $originalString = $request->input('je');
        $user = substr($originalString, 2);
        //dd($user);
        $arc = Archive::where('sPath', $pat)->first();
        //dd($arc);
        //get archive
        //$arc = Archive::where('sPath', $pat)->get();
        $id = $arc->id;
        $niv = $arc->sNiv;
        $vid = $arc->vid;
        $token = $arc->sToken;
        $spath = $arc->sPath;

        $path = $spath."/".$newname;
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }


        $folder = new Archive();
            $folder->sTyp = 3;
            $folder->sNiv = $niv+1;
            $folder->vid = $id;
            $folder->sToken = $token;
            $folder->sNom = $newname;
            $folder->sPath = $path;
            $folder->iShare = 1;
            $folder->iby = $user;
            $folder->isVld = 1;
        $folder->save();

        $folder_id = $folder->id;
        $hist = new ArchHisto();
            $hist->sAction = "Ajout Dossier";
            $hist->iType = 1;
            $hist->iArch = $folder_id;
            $hist->iBy = Auth::user()->id;
        $hist->save();


        return response()->json(["dir"=>$path, "txt"=>"Nouveau dossier crée sous nom :".$newname]);
    }
    //liste folder
    public function GetFolder($id)
    {
        $Folder = Archive::where('sTyp', 3)
                            //->orWhere('sTyp', 3)
                            ->where('id', $id)
                            ->first();
                            //->paginate(8);

        if (!empty($Folder)) {
            $docs = Document::whereHas('Archive', function($query) use($Folder){
                $query->where('iArch', $Folder->id);
            })->paginate(10);
        } else {
            $docs = [];
        }
        $doss = Archive::where('vid', $id)
                ->paginate(10);
        //dd($docs);
        //$docs = $archive->Docs;
        //$docs = ArchDoc::where('sToken', $div->token)->where('sNiv', '2')->paginate(15);
        $caty = Category::all();
        $path= $Folder->sPath;
        // Split the string into an array
        $breadcrumbs = explode('/', $path);

        // Initialize the breadcrumb HTML
        $html = '<ol class="breadcrumb">';
        $divs = Departement::select('id','code')->get();
        $scs = Service::select('id','code')->get();
        //dd($divs);
        //dd($breadcrumbs);
        // Loop through the array and add each item to the breadcrumb HTML
        foreach ($breadcrumbs as $key => $breadcrumb) {
            // Check if this is the last item in the array
            if ($key == count($breadcrumbs) - 1) {
                // Add the final item as an active breadcrumb
                $html .= '<li class="breadcrumb-item active" aria-current="page">' . $breadcrumb . '</li>';
            } else {
                // Add the item as a link
                if($breadcrumb=='CRI')
                {
                    $html .= '<li class="breadcrumb-item"><a href="'.route('home').'">' . $breadcrumb . '</a></li>';
                }
                elseif ($divs->contains('code', $breadcrumb)) {
                    $html .= '<li class="breadcrumb-item"><a href="'.route('arc.index', ['id'=>GetDivID($breadcrumb)]).'">' . $breadcrumb . '</a></li>';
                }
                elseif ($scs->contains('code', $breadcrumb)) {
                    $html .= '<li class="breadcrumb-item"><a href="'.route('arc.service', ['id'=>GetSerID($breadcrumb)]).'">' . $breadcrumb . '</a></li>';
                }
                else {
                    $html .= '<li class="breadcrumb-item">' . $breadcrumb . '</li>';
                }

            }
        }

        // Close the breadcrumb HTML
        $html .= '</ol>';

        return view('archive.folder', [
            'docs' => $docs,
            'folder' => $Folder,
            'doss' => $doss,
            'caty' => $caty,
            'nav' => $html
        ]);
    }

    public function GetFolders()
    {
        $user = Auth::user()->id;
        $prf = Auth::user()->profil;
        $aff = UserAffect::where('iUser', $user)->first();
        if ($prf==3) {
            if ($aff->iNiv==3) {
                $item = GetSrv($aff->iServ);
                $div = GetDiv($aff->iDiv);
                $path = storage_path('app/CRI/'.$div."/".$item);
            } else {
                $item = GetDiv($aff->iDiv);
                $path = storage_path('app/CRI/'.$item);
            }
        }
        else{
            $path = storage_path('app/CRI');
        }
        //dd($item);
        $directories = [];
        /* $directories[] = [
            'id' => $path,
            'pth' => $path,
            'parent' => '#',
            'text' => basename($path)
        ]; */
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                //dd($file);
                $pat = $file->getPathname();
                $start = strpos($pat, 'CRI');
                $length = strlen($pat) - $start;
                $result = substr($pat, $start, $length);
                //dd($result);
                //echo $lastPart;
                $directories[] = [
                    'id' => $file->getPathname(),
                    'pth' => $result,
                    'parent' => dirname($file->getPathname()) !== $path ? dirname($file->getPathname()) : '#',
                    'text' => basename($file->getPathname())
                ];
            }
        }
        //dd($directories);
        return response()->json($directories);
    }

    //Explorer
    public function Explorer()
    {
                //dd($path);
                $user = Auth::user()->id;
                $prf = Auth::user()->profil;
                $aff = UserAffect::where('iUser', $user)->first();
                if ($prf==3) {
                    if ($aff->iNiv==3) {
                        $item = GetSrv($aff->iServ);
                        $div = GetDiv($aff->iDiv);
                        $path = storage_path('app/CRI/'.$div."/".$item);
                    } else {
                        $item = GetDiv($aff->iDiv);
                        $path = storage_path('app/CRI/'.$item);
                    }
                }
                else{
                    $item ="CRI";
                    $path = storage_path('app/CRI');
                }
        return view('archive.explorer', [
            'src' => $item,
            'path' => $path
        ]);
    }
    public function ExplorerIt(Request $request)
    {
        $path = $request->input('pat');
        $root = storage_path('app/'.$path);
        //dd($root);
        $html = '';
        // Liste des fichiers

        $allFiles = Storage::allFiles($path);
        // Liste des dossiers
        $directories = Storage::allDirectories($path);
        function GetArch($at){
            $arc = Archive::where('sPath', $at)->first();
            //dd($arc);
            if (!empty($arc)) {
                if($arc->sTyp==3){
                    return route('arc.folder', [$arc->id]);
                }
                elseif ($arc->sTyp==2) {
                    return route('arc.service', [$arc->id]);
                }
                else{
                    return '#';
                }
            } else {
                return '#';
            }

        }

        $i = 1;
        foreach ($directories as $directory) {
            $dir = basename($directory);
            $html .= '<tr><td class="cell">'.$i.'</td>
            <td class="cell"><span class="truncate">'.$dir.'</span></td>
            <td class="cell"><span class="badge bg-success">Dossier</span></td>
            <td class="cell"><a class="btn-sm app-btn-secondary" href="'.GetArch($directory).'">Voir</a></td></tr>';
            $i++;
        }
        function GetFileShow($ref){
            $doc = Document::where('sPath', $ref)->first();
            if (!empty($doc)) {
                return route('doc.show',[$doc->id]);
            } else {
                return '#';
            }

        }
        foreach ($allFiles as $file) {
            $fich = basename($file);
            $html .= '<tr></tr><td class="cell">'.$i.'</td>
            <td class="cell"><span class="truncate">'.$fich.'</span></td>
            <td class="cell"><span class="badge bg-danger">Fichier</span></td>
            <td class="cell"><a class="btn-sm app-btn-secondary" href="'.GetFileShow($file).'">Voir</a></td></tr>';
            $i++;

        }

        //$html .= '</tr>';
        $res = json_encode($html);
        //return response()->json(['expo'=> $html, 'path'=>$path]);
        return response(['expo'=> $html, 'path'=>$path]);
    }

    public function ArcDoc()
    {
        $user = Auth::user()->id;
        $prf = Auth::user()->profil;
        $aff = UserAffect::where('iUser', $user)->first();
        if ($prf==3) {
            if ($aff->iNiv==3) {
                $item = GetSrv($aff->iServ);
                $div = GetDiv($aff->iDiv);
                //$docs = Document::where('isVld', 1)->where()->paginate(8);
                //SELECT * FROM documents INNER JOIN archives ON documents.iArch=archives.id WHERE archives.sNom ="SSLCDDC"
                $docs = Document::join('archives', 'documents.iArch','=','archives.id')
                                ->where('archives.sNom', $item)
                                ->where('documents.isVld', 1)
                                ->orwherein('documents.iShare', [1, 2, 3])
                                ->paginate(8);
            } else {
                $item = GetDiv($aff->iDiv);
                $docs = Document::join('archives', 'documents.iArch','=','archives.id')
                                ->where('archives.id', $aff->iDiv)
                                ->where('documents.isVld', 1)
                                ->orwherein('documents.iShare', [1, 2, 3])
                                ->paginate(8);
            }
        }
        else{
            $path = storage_path('app/CRI');
            $docs = Document::where('isVld', 1)->orwherein('documents.iShare', [1, 2, 3])->paginate(8);
        }

        return view('archive.liste', [
            'docs' => $docs
        ]);
    }

    public function createZipFile($id)
    {
        $arch = Archive::find($id);
        $path = $arch->sPath;
        $name = $arch->sNom;
        $zipFileName = $name.'.zip';
        $storagePath = storage_path($path);
        $root = storage_path('app/'.$path);
        //dd($root);
        $zip = new ZipArchive();
        //$zipFileName = 'public.zip';
        $zipFilePath = storage_path('app/'.$zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Get all directories inside storage/app/public
            $directories = Storage::allDirectories($path);

            // Add directories to the zip archive
            foreach ($directories as $directory) {
                $zip->addEmptyDir($directory);
            }

            // Get all files inside storage/app/public and add them to the zip archive
            $files = Storage::allFiles($path);
            foreach ($files as $file) {
                $zip->addFile(storage_path('app/'.$file), $file);
                //dd($file);
            }

            $zip->close();
            $hist = new ArchHisto();
            $hist->sAction = "Archive compressé et télécharger : ".$zipFileName;
            $hist->iType = 1;
            $hist->iArch = $arch->id;
            $hist->iBy = Auth::user()->id;
        $hist->save();

            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend();
        }


    }

    public function GenProjet(Request $request){
        $path = "CRI/DFAPSTC/Projets/".date('Y');
        $div = Departement::find(5);
        $serv = Service::find(9);
        $div = 5;
        $serv = 9;
        $niv = 5;
        $vid = 59;

        $NomProj = $request->projet;
        $IdProj = $request->num;
        $ProjPath =  $path.'/'.$NomProj;
        $item = [];

        if (!Storage::exists($ProjPath)) {
            Storage::makeDirectory($ProjPath);
        }


        $archive = New Archive();
            $archive->sTyp = 3;
            $archive->sNiv = 5;
            $archive->vid = $vid;
            $archive->sToken = 'a0a5d7f466b9a32cd632fe91f914b7dceffb0c03a830b28844e3dbeea2c81608';
            $archive->sNom = $NomProj;
            $archive->sPath = $ProjPath;
            $archive->iby = 666;
        $archive->save();

        $id = $archive->id;
        $hist = new ArchHisto();
            $hist->sAction = "Ajout Dossier Projet: ".$NomProj;
            $hist->iType = 3;
            $hist->iArch = $id;
            $hist->iBy = Auth::user()->id;
        $hist->save();
        //Archive::insert($item);
        $param = ["Etudes", "Arretes", "Autorisations", "Ecrits"];
        $i=1;
        foreach ($param as $value) {
            $path = $ProjPath."/".$value;
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            $item[] = [
                'sTyp' => 3,
                'sNiv' => 6,
                'vid' => $id,
                'sToken' => 'fabbc07d48ceb7480cfd121684b30d2ba62d0bfd0b499a481534b777c247225e',
                'sNom' => $value.'_'.$IdProj,
                'sPath' => $path,
                'iby' => 666
            ];
            $hist = new ArchHisto();
            $hist->sAction = "Ajout Sous-Dossier: ".$value." Projet :".$NomProj;
            $hist->iType = 3;
            $hist->iArch = $id;
            $hist->iBy = Auth::user()->id;
        $hist->save();
        }
        Archive::insert($item);


        return response()->json(['projet'=> $IdProj, 'path'=>$ProjPath, 'archive'=>$id]);

    }
    public function GenCrui(Request $request){
        $path = "CRI/DFAPSTC/CRUI/".date('Y');
        $div = Departement::find(5);
        $serv = Service::find(9);
        $div = 5;
        $serv = 9;
        $niv = 5;
        $vid = 62;

        $IdProj = $request->crui;
        $NomProj = 'Crui'.$IdProj.'_'.date('d_m_Y');
        $ProjPath =  $path.'/'.$NomProj;

        $item = [];

        if (!Storage::exists($ProjPath)) {
            Storage::makeDirectory($ProjPath);
        }


        $archive = New Archive();
            $archive->sTyp = 3;
            $archive->sNiv = 5;
            $archive->vid = $vid;
            $archive->sToken = 'a0a5d7f466b9a32cd632fe91f914b7dceffb0c03a830b28844e3dbeea2c81608';
            $archive->sNom = $NomProj;
            $archive->sPath = $ProjPath;
            $archive->iby = 666;
        $archive->save();

        $id = $archive->id;
        $hist = new ArchHisto();
            $hist->sAction = "Ajout Crui : ".$NomProj;
            $hist->iType = 4;
            $hist->iArch = $id;
            $hist->iBy = Auth::user()->id;
        $hist->save();
        //Archive::insert($item);
        $param = ["FOND DOSSIER", "PVs", "Lettres de notification", "convocation"];
        $i=1;
        foreach ($param as $value) {
            $path = $ProjPath."/".$value;
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            $item[] = [
                'sTyp' => 3,
                'sNiv' => 6,
                'vid' => $id,
                'sToken' => 'fabbc07d48ceb7480cfd121684b30d2ba62d0bfd0b499a481534b777c247225e',
                'sNom' => $value.'_'.$IdProj,
                'sPath' => $path,
                'iby' => 666
            ];
            $hist = new ArchHisto();
                $hist->sAction = "Ajout Dossier : ".$value." pour Crui : ".$NomProj;
                $hist->iType = 4;
                $hist->iArch = $id;
                $hist->iBy = Auth::user()->id;
            $hist->save();
        }
        Archive::insert($item);


        return response()->json(['projet'=> $IdProj, 'path'=>$ProjPath, 'archive'=>$id]);

    }

}
