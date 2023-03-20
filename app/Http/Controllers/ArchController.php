<?php

namespace App\Http\Controllers;

use App\Models\Arch;
use App\Http\Requests\StoreArchRequest;
use App\Http\Requests\UpdateArchRequest;
use App\Models\Category;
use App\Models\Departement;
use App\Models\Doc;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class ArchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //liste
        //dd($arch);

        $div = Departement::findorfail($id);
        $serv = Service::where('division', $div->id)->get();
        $docs = Doc::where('token', $div->token)->where('ispublic', '3')->paginate(15);
        $caty = Category::all();
        //dd($docs);
        return view('archive.index', [
            'div' => $div,
            'serv' => $serv,
            'docs' => $docs,
            'cat' => $caty
        ]);
    }

    //liste service
    public function indexService($id)
    {
        $serv = Service::findorfail($id);
        $div = Departement::select('division', 'code', 'token')->where('id', $serv->division)->first();
        $docs = Doc::where('token', $div->token)->where('ispublic', '2')->paginate(15);

        return view('archive.service', [
            'div' => $div,
            'serv' => $serv,
            'docs' => $docs
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //add new
        //dd('test');
        $caty = Category::all();
        $div = Departement::all();

        return view('archive.create', [
            'caty' => $caty,
            'divs' => $div
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArchRequest $request)
    {
        //
    }
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
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            // Do something with the validation errors, such as flash them to the session
            return response()->json(['success'=>$errors]);
        }
        //dd($request->all());
        // Get the file from the request
        $file = $request->file('file');

        $token = GetToken(Auth::user()->div);
        $div = GetDiv(Auth::user()->div);
        // Check if the folder exists, create it if it doesn't
        $folderName = 'CRI/'.$div.'/'.date('Y').'/PV';
        if (!Storage::exists($folderName)) {
            Storage::makeDirectory($folderName);
        }

        // Store the file in the folder
        $filename = $file->getClientOriginalName();
        $checkfile = $folderName.'/'.$filename;
        if (!Storage::exists($checkfile)) {
            $file->storeAs($folderName, $filename);
            //$file->storePublicly($filename,'private');
            // If you want to save the file path to a database, you can do so here
        } else {
            return response()->json(['success' => 'File already exists.'], 400);
        }
        //$file->storeAs($folderName, $filename);


       $file = new Doc();
       $file->objet = $request->objet;
       $file->ref = $request->ref; //date('Y').'/CRI';
       $file->dte = $request->date; //date('Y-m-d');
       $file->token = $token;
       $file->caty = $request->categorie;
       $file->type = 1;
       $file->annee = date('Y');
       $file->user = Auth::user()->id;
       $file->tags = json_encode($request->tags);
       $file->filename = $filename;
       $file->filepath =$folderName.'/'.$filename;
       $file->ispublic = $request->partage;
       $file->vu = 0;
       $file->isClose = 0;
       $file->save();
        $msg ='Le Document a été chargé avec succès!.';
        return response()->json(['success'=>$msg, 'red'=>json_encode($request->all())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function show($arch)
    {
        //show it
        $doc = Doc::findorfail($arch);

        return view('archive.show', [
            'doc' => $doc
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function edit(Arch $arch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArchRequest  $request
     * @param  \App\Models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArchRequest $request, Arch $arch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arch  $arch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arch $arch)
    {
        //
    }

    public function GetMulti(){
        return view('archive.multi');
    }
    public function MultiUpload(Request $request)
    {
        //$year = $request->input('year');
        $year = date('Y');
        //$path = public_path('uploads/' . $year);
        $file = $request->file('file');

        $token = GetToken(Auth::user()->div);
        $div = GetDiv(Auth::user()->div);
        // Check if the folder exists, create it if it doesn't
        $folderName = 'CRI/'.$div.'/'.$year.'/PV';
        if (!Storage::exists($folderName)) {
            Storage::makeDirectory($folderName);
        }

        // Store the file in the folder
       // $filename = $file->getClientOriginalName();
       foreach ($request->file('files') as $file) {
           $filename = $file->getClientOriginalName();
           //$file->move($path, $filename);
           $checkfile = $folderName.'/'.$filename;
           if (!Storage::exists($checkfile)) {
               $file->storeAs($folderName, $filename);
            //$file->storePublicly($filename,'private');
            // If you want to save the file path to a database, you can do so here
        } else {
            return response()->json(['success' => 'File already exists.'], 400);
        }
        }




        return 'Files uploaded successfully!';
    }
}
