<?php

namespace App\Http\Controllers;

use App\Models\ArchHisto;
use App\Models\Archive;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Service;
use App\Models\Category;
use App\Models\DocVersion;
use App\Models\UserAffect;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Zxing\QrReader;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




class DocumentController extends Controller
{
    //liste Docs
    public function index()
    {

    }

    public function show($id)
    {
        $doc = Document::findorfail($id);
        $path= $doc->sPath;
        // Split the string into an array
        $breadcrumbs = explode('/', $path);

        // Initialize the breadcrumb HTML
        $html = '<ol class="breadcrumb">';
        $divs = Departement::select('id','code')->get();
        $scs = Service::select('id','code')->get();
        //dd($divs);
        //dd($breadcrumbs);
        // Loop through the array and add each item to the breadcrumb HTML
        $labdiv = 'CRI';
        $labserv = 'CRI';
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
                    $labdiv = $breadcrumb;
                }
                elseif ($scs->contains('code', $breadcrumb)) {
                    $html .= '<li class="breadcrumb-item"><a href="'.route('arc.service', ['id'=>GetSerID($breadcrumb)]).'">' . $breadcrumb . '</a></li>';
                    $labserv = $breadcrumb;
                }
                else {
                    $html .= '<li class="breadcrumb-item">' . $breadcrumb . '</li>';

                }

            }
        }

        // Close the breadcrumb HTML
        $html .= '</ol>';
        return view('docs.show', [
            'doc' => $doc,
            'nav' => $html,
            'labdiv' => $labdiv ,
            'labserv' => $labserv
        ]);
    }

    //create new
    public function create()
    {
        //add new
        //dd('test');
        $caty = Category::all();
        $div = Departement::all();
        $user = Auth::user()->id;
        $prf = Auth::user()->profil;
        $aff = UserAffect::where('iUser', $user)->first();
        if ($prf==3) {
            if ($aff->iNiv==3) {
                $item = GetSrv($aff->iServ);
                $div = GetDiv($aff->iDiv);
                $arch = Archive::where('sNom', $item)->first();
            } else {
                $item = GetDiv($aff->iDiv);
                $arch = Archive::where('id', $aff->iDiv)->first();
            }
        }
        else{
            $path = storage_path('app/CRI');
        }

        //dd($arch);
        return view('archive.createg', [
            'caty' => $caty,
            'divs' => $div,
            'arch' => $arch,
            //'options' => $options
        ]);
    }
    public function NewDoc($arc)
    {
        //Upload New Doc
        $caty = Category::all();
        $archive = Archive::find($arc);


        return view('docs.create', [
            'caty' => $caty,
            'arc' => $archive
            //'options' => $options
        ]);
    }
    //Upload Onefile
     //another way
     public function GetUpload(Request $request)
     {
         /* $request->validate([
             'file' => 'required|file|max:204800',
         ]); */
         $validator = Validator::make($request->all(), [
             'objet' => 'required|string|max:255',
             'file' => 'required|',
             'ref' => 'required|string|min:4',
             'archive' => 'required',
         ]);
         if ($validator->fails()) {
             $errors = $validator->errors();
             // Do something with the validation errors, such as flash them to the session
             return response()->json(['success'=>$errors]);
         }
         //dd($request->all());
         // Get the file from the request
         $file = $request->file('file');

         $folder = $request->archive;
         $arc = $request->input('ac');


        $archive = Archive::find($arc);
        //dd($arc);
        $token = $archive->sToken;
        //$folder = '';
        $numArch = $archive->id;
         //$div = GetDiv(Auth::user()->div);
         // Check if the folder exists, create it if it doesn't
         //$folderName = 'CRI/'.$archDiv.'/'.date('Y').'/Docs';
         if (!Storage::exists($folder)) {
             Storage::makeDirectory($folder);
         }

         // Store the file in the folder
         $filename = $file->getClientOriginalName();
         $fileExt = $file->getClientMimeType();
         $checkfile = $folder.'/'.$filename;
         if (!Storage::exists($checkfile)) {
             $file->storeAs($folder, $filename);
             //$file->storePublicly($filename,'private');
             // If you want to save the file path to a database, you can do so here
         } else {
             return response()->json(['success' => 'File already exists.'], 400);
         }



         //$file->storeAs($folderName, $filename);

        $file = new Document();
            $file->sObjet = $request->objet;
            $file->sRef = $request->ref;
            $file->dDte = $request->date;
            $file->iAnne = date('Y');
            $file->iBy = Auth::user()->id;
            $file->sFile = $filename;
            $file->sExt = $fileExt;
            $file->sPath = $checkfile;
            $file->iCaty = $request->categorie;
            $file->iArch = $numArch;
            $file->sTags = json_encode($request->tags);
            $file->iType = 1;
            $file->iShare = 1;
            $file->isVld = 1;
        $file->save();

        $id = $file->id;
         //Gen Arch Doc
         $hist = new ArchHisto();
            $hist->sAction = "Ajout Document : ".$request->objet;
            $hist->iType = 2;
            $hist->iArch = $id;
            $hist->iBy = Auth::user()->id;
        $hist->save();

         $msg ='Le Document a été chargé avec succès!.';
         return response()->json(['success'=>$msg, 'red'=>$file->id]);
     }

     public function GetMulti($id){
        $arc = Archive::find($id);
        return view('archive.multi', [
            'arc' => $arc
        ]);
    }
    public function UpMultiFiles()
    {
        //add new
        //dd('test');
        $caty = Category::all();
        $div = Departement::all();
        $mydiv = Auth::user()->div;
        $arch = Archive::where('id', $mydiv)->first();
        //dd($arch);
        return view('archive.multiarc', [
            'caty' => $caty,
            'divs' => $div,
            'arch' => $arch,
            //'options' => $options
        ]);
    }
    public function MultiUpload(Request $request)
    {
        //$year = $request->input('year');
        $year = date('Y');
        //$path = public_path('uploads/' . $year);
        $file = $request->file('file');
        $folder = $request->archive;
        $arc = $request->input('ac');


       $archive = Archive::find($arc);
       //dd($arc);
       $token = $archive->sToken;
       //$folder = '';
       $numArch = $archive->id;

        /* $token = GetToken(Auth::user()->div);
        $div = GetDiv(Auth::user()->div); */
        // Check if the folder exists, create it if it doesn't
        //$folderName = 'CRI/'.$div.'/'.$year.'/PV';
        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        // Store the file in the folder
       // $filename = $file->getClientOriginalName();
       $i = 1;
       foreach ($request->file('files') as $file) {
           $filename = $file->getClientOriginalName();
           $fileExt = $file->getClientMimeType();
           //$file->move($path, $filename);
           $checkfile = $folder.'/'.$filename;
           if (!Storage::exists($checkfile)) {
               $file->storeAs($folder, $filename);
               $ufile = new Document();
               $ufile->sObjet = "CRI_".$filename;
               $ufile->sRef = $filename;
               $ufile->dDte = date('Y-m-d');
               $ufile->iAnne = date('Y');
               $ufile->iBy = Auth::user()->id;
               $ufile->sFile = $filename;
               $ufile->sExt = $fileExt;
               $ufile->sPath = $checkfile;
               $ufile->iCaty = 3;
               $ufile->iArch = $numArch;
               $ufile->sTags = json_encode(['CRI', 'Multi']);
               $ufile->iType = 1;
               $ufile->iShare = 1;
               $ufile->isVld = 0;
           $ufile->save();
           $id = $ufile->id;
           $hist = new ArchHisto();
                $hist->sAction = "Ajout Document : ".$filename;
                $hist->iType = 2;
                $hist->iArch = $id;
                $hist->iBy = Auth::user()->id;
            $hist->save();
            //$file->storePublicly($filename,'private');
            // If you want to save the file path to a database, you can do so here
            //Gen Arch Doc

        } else {
            return response()->json(['success' => 'File already exists.'], 400);
        }
        $i++;
        }




        return 'Files uploaded successfully!';
    }

    //download file
    public function GetFile($id)
    {
        //dd($id);
        $doc = Document::findorfail($id);
        $filename = $doc->sPath;
        //dd($filename); // move this line before the $filename assignment
        //$url = Storage::url($filename);
        $filePath = Storage::path($filename);
        $fileContents = file_get_contents($filePath);

        return response()->download($filePath);

    }

    public function DocOff($id)
    {
        $doc = Document::findorfail($id);
        //dd($doc);
        if ($doc->isVld == 1) {
            $doc->isVld = 0;
            $doc->save();
            //$doc->update(['isVld', 0]);
        } else {
           $doc->isVld = 1;
           $doc->save();
            //$doc->update(['isVld', 1]);
        }

        $hist = new ArchHisto();
                $hist->sAction = "Modifier visibilité Document : ".$doc->sObjet;
                $hist->iType = 2;
                $hist->iArch = $id;
                $hist->iBy = Auth::user()->id;
            $hist->save();


        return redirect()->route('doc.show', ['doc'=>$doc->id]);
    }

    public function search()
    {
        $cats = Category::all();
        $dateOne = Document::select('dDte')->orderBy('dDte', 'ASC')->first();
        $dateLast = Document::select('dDte')->orderBy('dDte', 'DESC')->first();
        $dOne = Carbon::createFromFormat('Y-m-d', $dateOne->dDte)->format('m/d/Y');
        $dLast = Carbon::createFromFormat('Y-m-d', $dateLast->dDte)->format('m/d/Y');
        //dd($dOne);
        return view('docs.search', [
            'cat' => $cats,
            'dOne' => $dOne,
            'dLast' => $dLast
        ]);
    }
    public function GetResult(Request $request)
    {
        $vars = $request->all();
        //dd($vars);
        $_token = $request->_token;
        $objet = $request->objet;
        $ref = $request->ref;
        $tag = $request->tag;
        $type = $request->type;
        //$daterange = $request->daterange;
        $docs = Document::query();
        //$docs->where('iShare', 3);
        if ($objet!=null && !empty($objet)) {
            $docs->Where('sObjet', 'like', '%'.$objet.'%');
        }
        if ($ref!=null && !empty($ref)) {
            $docs->Where('sRef', 'like', '%'.$ref.'%');
        }
        if ($tag!=null && !empty($tag)) {
            $docs->Where('sTags', 'like', '%'.$tag.'%');
        }
        if ($type<>-1) {
            $docs->Where('iCaty', $type);
        }
        if ($type<>-1) {
            $docs->wherein('iShare', [1, 2, 3]);
        }
        //$defrang = date('m-d-Y')." - ".date('m-d-Y');
        //$dateRange = "01/01/2018 - 01/15/2018";
        //$dates = explode(" - ", $daterange);
        /* $dtein = date('Y-m-d H:i:s', strtotime($dates[0]));
        $dteout = date('Y-m-d H:i:s', strtotime($dates[1])); */
        $dtein = $request->dateDe;
        $dteout =$request->dateAu;
        if ($dtein!=null && !empty($dtein)) {
            $dOne = Carbon::createFromFormat('Y-m-d', $dtein)->format('Y-m-d');
            if ($dteout!=null && !empty($dteout)) {
                $dLast = Carbon::createFromFormat('Y-m-d', $dteout)->format('Y-m-d');
            }else{
                $dLast = date('Y-m-d');
            }
            $docs->whereBetween('dDte', [$dOne, $dLast]);
        }

        /*
        $dOne = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
        $dLast = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d'); */

        $docs->get();
        $html = '';
        $i = 1;
        //dd($docs);
        $data = $docs->get();
        foreach($data as $key => $value) {
            $html .= '<tr>';
            $html .= '   <td class="cell">'.$i.'</td>';
             $html .= '<td class="cell"><span class="truncate">'.$value->sObjet.'</span></td>';
             $html .= '<td class="cell"><span class="truncate">'.$value->sRef.'</span></td>';
             $html .= '<td class="cell"><span class="badge bg-success">'.GetCaty($value->iCaty).'</span></td>';
             $html .= '<td class="cell">'.$value->dDte.'</td>';
             $html .= '<td class="cell"><a class="btn-sm app-btn-secondary" href="'.route('doc.show', [$value->id]).'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">';
             $html .= '    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>';
             $html .= '    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>';
             $html .= '    </svg></a></td>';
            $html .='</tr>';
            $i++;
            //dd($value);
        }
        //dd($docs->count());
        $nb = $data->count();
        return response(['data'=>$html, 'nb'=>$nb]);
    }
    public function edit($id)
    {
        $doc = Document::findorfail($id);
        $caty = Category::all();
        // Split the string into an array
        if (empty($doc->tags)) {
            $tags = ["CRI", "Archive", date('Y')];
        } else {
            $tags = json_decode($doc->sTags);
        }

        $path= $doc->sPath;
        $breadcrumbs = explode('/', $path);

        // Initialize the breadcrumb HTML
        $html = '<ol class="breadcrumb">';
        $divs = Departement::select('id','code')->get();
        $scs = Service::select('id','code')->get();
        //dd($divs);
        //dd($breadcrumbs);
        // Loop through the array and add each item to the breadcrumb HTML
        $labdiv = 'CRI';
        $labserv = 'CRI';
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
                    $labdiv = $breadcrumb;
                }
                elseif ($scs->contains('code', $breadcrumb)) {
                    $html .= '<li class="breadcrumb-item"><a href="'.route('arc.service', ['id'=>GetSerID($breadcrumb)]).'">' . $breadcrumb . '</a></li>';
                    $labserv = $breadcrumb;
                }
                else {
                    $html .= '<li class="breadcrumb-item">' . $breadcrumb . '</li>';

                }

            }
        }

        // Close the breadcrumb HTML
        $html .= '</ol>';
        $arch = Archive::where('id', $doc->iArch)->first();

        return view('docs.edit', [
            'doc' => $doc,
            'caty' => $caty,
            'nav' => $html,
            'labdiv' => $labdiv ,
            'labserv' => $labserv,
            'arc' => $arch,
            'tags' => $tags
        ]);
    }
    public function UpEdit(Request $request)
    {
        //dd($request->all());
        /* $iDoc = $request->dc;
        $iArc = $request->ac;
        $doc = Document::findorfail($iDoc);
        $arc = Archive::findorfail($iArc);
        $folder = dirname($doc->sPath);
        $file = $request->file('file');

        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        // Store the file in the folder
        $filename = $file->getClientOriginalName();
        $fileExt = $file->getClientMimeType();
        $checkfile = $folder.'/'.$filename;
        if (!Storage::exists($checkfile)) {
            $file->storeAs($folder, $filename);
        } else {
            $newcheckfile = substr_replace($checkfile, '_1', strrpos($checkfile, '.'), 0);
           // Rename the file
           if (file_exists($checkfile)) {
               rename($checkfile, $newcheckfile);
               $file->storeAs($folder, $filename);
           }
        }

        return response()->json(['path'=>$checkfile, 'fl'=>$filename, 'fex'=>$fileExt, 'success'=>"Fichier chargé avec succès!"]);
 */
        $iDoc = $request->dc;
        $iArc = $request->ac;
        $u = $request->u;
        $doc = Document::findorfail($iDoc);
        $arc = Archive::findorfail($iArc);
        $folder = dirname($doc->sPath);
        $file = $request->file('file');

        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        // Store the file in the folder
        $filename = $file->getClientOriginalName();
        $fileExt = $file->getClientMimeType();

        $checkfile = $folder.'/'.$filename;

        if (!Storage::exists($checkfile)) {
            $file->storeAs($folder, $filename);
        } else {
            $i = 1;
             $path = $folder.'/'.$filename;
            while (true) {
                $newcheckfile = substr_replace($checkfile, '_' . $i, strrpos($checkfile, '.'), 0);
                if (!Storage::exists($newcheckfile)) {
                    rename(storage_path('app/' . $checkfile), storage_path('app/' . $newcheckfile));
                    $file->storeAs($folder, $filename);
                    $checkfile = $newcheckfile;
                    break;
                }
                $i++;
            }
        }
        $version = new DocVersion();
            $version->iDoc = $iDoc;
            $version->sNomOld = $checkfile;
            $version->sNomNew = $path;
            $version->iBy = $u;
        $version->save();

        $hist = new ArchHisto();
                $hist->sAction = "Changement fichier Document : ".$filename;
                $hist->iType = 2;
                $hist->iArch = $iDoc;
                $hist->iBy = $u;
            $hist->save();

        return response()->json(['path'=>$path, 'fl'=>$filename, 'fex'=>$fileExt, 'success'=>"Fichier chargé avec succès!"]);

    }
    public function update(Request $request, $id)
    {
        $doc = Document::findorfail($id);


         $folder = dirname($doc->sPath);
         $arc = $doc->iArch;

        //dd($request);
        $archive = Archive::find($arc);
        //dd($arc);
        $token = $archive->sToken;
        //$folder = '';
        $numArch = $archive->id;
        $filename = $request->fl;
        $fileExt = $request->fext;
        $farch = $request->archive;

            $doc->sObjet = $request->objet;
            $doc->sRef = $request->ref;
            $doc->dDte = $request->date;
            $doc->iAnne = date('Y');
            $doc->iBy = Auth::user()->id;
            $doc->sFile = $filename;
            $doc->sExt = $fileExt;
            $doc->sPath = $farch;
            $doc->iCaty = $request->categorie;
            $doc->iArch = $numArch;
            $doc->sTags = json_encode($request->tags);
            $doc->iType = 1;
            $doc->iShare = 1;
            $doc->isVld = 1;
        $doc->save();

        $hist = new ArchHisto();
                $hist->sAction = "Mise à jour Infos Document : ".$filename;
                $hist->iType = 2;
                $hist->iArch = $doc->id;
                $hist->iBy = Auth::user()->id;
            $hist->save();
         //Gen Arch Doc
        //dd($doc);
         $msg ='Le Document a été modifier avec succès!.';
         return response()->json(['success'=>$msg, 'red'=>$doc->id]);
    }
    public function ReadBar(Request $request)
    {
        $file = $request->file('file');
        $folder = Storage::path('public');

        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        // Store the file in the folder
        $filename = $file->getClientOriginalName();
        $fileExt = $file->getClientMimeType();
        $checkfile =  $folder.'/'.$filename;
        //$cfile = imagejpeg($filename,$checkfile);
        $file->storeAs('public', $filename);
        //$filename = $file->store('public');
        /* $py = Storage::path('bin/ai.py');
        $decoded_data = shell_exec("python $py $checkfile 2>&1");
        if ($decoded_data) {
            dd($decoded_data);
        } */

        $decodedData = QRcode::decode($checkfile);

        // Return the decoded data as a response
        return response()->json(['data' => $decodedData]);
    }
}
