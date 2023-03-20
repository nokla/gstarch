<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/gserv', [App\Http\Controllers\DepartementController::class, 'GetServs'])->name('cri.servs');
Route::post('/gdoss', [App\Http\Controllers\DepartementController::class, 'GetDoss'])->name('cri.doss');
Route::post('/newfolder', [App\Http\Controllers\ArchiveController::class, 'NewFolder'])->name('cri.newfolder');
Route::post('/newfoldertwo', [App\Http\Controllers\ArchiveController::class, 'NewFolderTwo'])->name('cri.newfoldertwo');
Route::post('/givemefolder', [App\Http\Controllers\ArchiveController::class, 'ArchMakeDir'])->name('cri.givemefolder');
//Route::get('/gfolders', [App\Http\Controllers\ArchiveController::class, 'GetFolders'])->name('cri.folders');
Route::post('/explore', [App\Http\Controllers\ArchiveController::class, 'ExplorerIt'])->name('cri.explore');
Route::post('/upedit', [App\Http\Controllers\DocumentController::class, 'UpEdit'])->name('cri.editup');
Route::post('/readbar', [App\Http\Controllers\DocumentController::class, 'ReadBar'])->name('cri.readbar');
Route::post('/projet', [App\Http\Controllers\ArchiveController::class, 'GenProjet'])->name('cri.gprojet');
Route::post('/crui', [App\Http\Controllers\ArchiveController::class, 'GenCrui'])->name('cri.gcrui');

