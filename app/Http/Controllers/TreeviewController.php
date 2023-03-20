<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TreeviewController extends Controller
{
    //
    public function index()
    {
        //$files = Storage::disk('public')->allFiles('/'); // Get all files and directories in the root directory
        $directory = "public";
        //$files = Storage::allFiles($directory);
        $files = Storage::disk('publicdir')->allFiles('/');
       //$files = public_path('/');
        $tree = $this->buildTree($files); // Build the tree structure

        return view('archive.treeview', ['tree' => $tree]);
    }
    private function buildTree($files, $delimiter = '/')
    {
        $tree = [];

        foreach ($files as $file) {
            $parts = explode($delimiter, $file);

            $branch = &$tree;
            foreach ($parts as $part) {
                if (!isset($branch[$part])) {
                    $branch[$part] = [];
                }

                $branch = &$branch[$part];
            }
        }
        //dd($files);
        return $tree;
    }

}
