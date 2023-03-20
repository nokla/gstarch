<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArchController;
use Illuminate\Http\Client\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('layouts.cri');
}); */
/* Route::get('/arc', function () {
    return view('archive.liste');
}); */

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'PubArch'])->name('public');

Route::get('/dbadmin', function () {
    return view('dbadmin.index');
});

Route::get('/dbadmin2', function () {
    return view('dbadmin.dash');
});

Route::group(['middleware' => 'auth'], function () {
    // User needs to be authenticated to enter here.
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //departement
    Route::get('/cri/new', [App\Http\Controllers\DepartementController::class, 'addnew'])->name('cri.new');
    Route::post('/cri/add', [App\Http\Controllers\DepartementController::class, 'savedep'])->name('cri.add');

    //Archive
    Route::get('/archive/{id}', [App\Http\Controllers\ArchiveController::class, "index"])->name('arc.index')->where('id', '[0-9]+');
    //Route::get('/lst', [App\Http\Controllers\ArchController::class, 'liste'])->name('arc.list');
    Route::get('/folder/{id}', [App\Http\Controllers\ArchiveController::class, 'GetFolder'])->name('arc.folder')->where('id', '[0-9]+');
    Route::get('/explorer', [App\Http\Controllers\ArchiveController::class, 'Explorer'])->name('arc.explorer');
    Route::get('/lst', [App\Http\Controllers\ArchiveController::class, 'ArcDoc'])->name('arc.lst');
    Route::get('/zip/{id}', [App\Http\Controllers\ArchiveController::class, 'createZipFile'])->where('id', '[0-9]+')->name('arc.zip');
    Route::get('/gfolders', [App\Http\Controllers\ArchiveController::class, 'GetFolders'])->name('cri.folders');


    //Route::get('/arc/{id}', [App\Http\Controllers\ArchiveController::class, 'index'])->name('arc.index')->where('id', 'numeric');
    //Route::get('/doc/new', [App\Http\Controllers\ArchController::class, 'create'])->name('arc.create');
    //Route::get('/doc/{doc}', [App\Http\Controllers\ArchController::class, 'show'])->name('arc.show');
    Route::post('/upload', [App\Http\Controllers\DocumentController::class, 'GetUpload'])->name('doc.upload');
    Route::post('/mupload', [App\Http\Controllers\DocumentController::class, 'MultiUpload'])->name('doc.mupload');
    Route::get('/sec/{id}', [App\Http\Controllers\ArchiveController::class, 'indexService'])->name('arc.service');
    Route::get('/multi/{id}', [App\Http\Controllers\DocumentController::class, 'GetMulti'])->name('doc.multi');
    Route::get('/multifiles/', [App\Http\Controllers\DocumentController::class, 'UpMultiFiles'])->name('doc.upmulti');
    //Route::post('/newfolder', [App\Http\Controllers\ArchiveController::class, 'NewFolder'])->name('cri.newfolder');
    //Route::post('/gserv', [App\Http\Controllers\DepartementController::class, 'GetServs'])->name('cri.servs');
    //Route::post('/newfolder', [App\Http\Controllers\ArchiveController::class, 'NewFolder'])->name('cri.newfolder');


    //Route::resource('arc', \App\Http\Controllers\ArchController::class);
    //Route::get('/arc/add', [App\Http\Controllers\ArchController::class, 'add'])->name('arc.list');

    //docs
    Route::resource('doc', \App\Http\Controllers\DocumentController::class);
    Route::get('/doc/new/{arc}', [App\Http\Controllers\DocumentController::class, 'NewDoc'])->name('doc.NewDoc')->where('arc', '[0-9]+');
    Route::get('/doc/get/{id}', [App\Http\Controllers\DocumentController::class, 'GetFile'])->name('doc.down')->where('id', '[0-9]+');
    Route::get('/doc/off/{id}', [App\Http\Controllers\DocumentController::class, 'DocOff'])->name('doc.off')->where('id', '[0-9]+');
    Route::get('/search', [App\Http\Controllers\DocumentController::class, 'search'])->name('doc.search');
    Route::post('/result', [App\Http\Controllers\DocumentController::class, 'GetResult'])->name('doc.result');

    Route::get('/aidoc', function() {
        return view('docs.read');
    });

    //test AI
    Route::get('/AI', [\App\Http\Controllers\MakeAI::class, 'GetTexte'])->name('ai');
    Route::get('/qr', [\App\Http\Controllers\MakeAI::class, 'ReadCode'])->name('code');
    Route::get('/treeview', [\App\Http\Controllers\TreeviewController::class, 'index'])->name('treeview.index');
    //Route::view('dbadmin.index')->name('dbadmin');
    Route::get('/confdiv', [\App\Http\Controllers\ConfigAppController::class, 'GenArchs'])->name('GenArchs');
    Route::get('/confserv', [\App\Http\Controllers\ConfigAppController::class, 'GenArchServ'])->name('GenArchServ');
    Route::get('/useraff', [\App\Http\Controllers\ConfigAppController::class, 'UserAffect'])->name('UserAffect');

    Route::get('/4explorer', function () {
        $root = public_path('app/CRI');
        $directory = scandir($root);
        $ignore = array('.', '..', '.gitignore', '.htaccess');
        $files = array_diff($directory, $ignore);
        $result = array();
        foreach ($files as $file) {
            if (is_dir($root . '/' . $file)) {
                $result[] = array(
                    'type' => 'folder',
                    'name' => $file,
                    'path' => $root . '/' . $file,
                );
            } else {
                $result[] = array(
                    'type' => 'file',
                    'name' => $file,
                    'path' => $root . '/' . $file,
                );
            }
        }
        return response()->json($result);
    });
    Route::get('/proj_api', function () {
        return view('archive.api');
    });
    Route::get('/crui_api', function () {
        return view('archive.crui');
    });
});



