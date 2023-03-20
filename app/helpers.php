<?php

// Our Custom Funcs

use App\Models\Category;
use App\Models\Departement;
use App\Models\Service;
use App\Models\User;

//get Token
function GetToken($id)
{
    $div = Departement::find($id);
    $token = $div->token;

    return $token;
}

//get catygorie
function GetCaty($id)
{
    $caty = Category::find($id);

    return $caty->category;
}

//Get divServ
function GetDiv($id)
{
    if ($id==-1) {
        $lab = 'CRI';
    } else {
        $div = Departement::find($id);
        $lab = $div->code;
    }


    return $lab;
}
function GetSrv($id)
{
    if ($id==-1) {
        $lab = 'CRI';
    } else {
        $div = Service::find($id);
        $lab = $div->code;
    }


    return $lab;
}
function GetDivID($div)
{
    $div = Departement::select('id', 'code')->where('code', $div)->first();

    return $div->id;
}
function GetSerID($srv)
{
    $serv = Service::select('id', 'code')->where('code', $srv)->first();

    return $serv->id;
}
//Get divServ
function GetDivName($id)
{
    //dd($id);
    if ($id==-1) {
        $lab = 'CRI';
    } else {
        $div = Departement::find($id);
        $lab = $div->division;
    }


    return $lab;
}
function GetExtIcon($ext)
{
    // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
    // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
        static $font_awesome_file_icon_classes = [
            // Images
            'image'                                                                     => 'fa-file-image',
            // Audio
            'audio'                                                                     => 'fa-file-audio',
            // Video
            'video'                                                                     => 'fa-file-video',
            // Documents
            'application/pdf'                                                           => 'fa-file-pdf',
            'application/msword'                                                        => 'fa-file-word',
            'application/vnd.ms-word'                                                   => 'fa-file-word',
            'application/vnd.oasis.opendocument.text'                                   => 'fa-file-word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml'            => 'fa-file-word',
            'application/vnd.ms-excel'                                                  => 'fa-file-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml'               => 'fa-file-excel',
            'application/vnd.oasis.opendocument.spreadsheet'                            => 'fa-file-excel',
            'application/vnd.ms-powerpoint'                                             => 'fa-file-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml'              => 'ffa-file-powerpoint',
            'application/vnd.oasis.opendocument.presentation'                           => 'fa-file-powerpoint',
            'text/plain'                                                                => 'fa-file-alt',
            'text/html'                                                                 => 'fa-file-code',
            'application/json'                                                          => 'fa-file-code',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'fa-file-word',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'fa-file-excel',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'fa-file-powerpoint',
            // Archives
            'application/gzip'                                                          => 'fa-file-archive',
            'application/zip'                                                           => 'fa-file-archive',
            'application/x-zip-compressed'                                              => 'fa-file-archive',
            // Misc
            'application/octet-stream'                                                  => 'fa-file-archive',
        ];

        if (isset($font_awesome_file_icon_classes[$ext]))
            return $font_awesome_file_icon_classes[$ext];

        $mime_group = explode('/', $ext, 2)[0];
        return (isset($font_awesome_file_icon_classes[$mime_group])) ? $font_awesome_file_icon_classes[$mime_group] : 'fa-file';
}

function getMimeTypeByExtension($extension) {
    $mimeTypes = collect([
        'Image jpg' => 'image/jpeg',
        'Image png' => 'image/png',
        'Image gif' => 'image/gif',
        'Image bmp' => 'image/bmp',
        'Image svg' => 'image/svg+xml',
        'Image webp' => 'image/webp',
        'Image ico' => 'image/x-icon',
        'Image tif' => 'image/tiff',
        'Image tiff' => 'image/tiff',
        'Fichier pdf' => 'application/pdf',
        'Fichier MS doc' => 'application/msword',
        'Fichier MS docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'Fichier MS xls' => 'application/vnd.ms-excel',
        'Fichier MS xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Fichier MS xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Fichier MS ppt' => 'application/vnd.ms-powerpoint',
        'Fichier MS pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'Ficher txt' => 'text/plain',
        'Page html' => 'text/html',
        'Fichier xml' => 'text/xml',
        'Fichier json' => 'application/json',
        'Fichier Compressé zip' => 'application/zip',
        'Fichier Compressé tar' => 'application/x-tar',
        'Fichier Compressé gz' => 'application/x-gzip',
        'Fichier Compressé rar' => 'application/x-rar-compressed',
        'Fichier Compressé 7z' => 'application/x-7z-compressed',
        // Add more mime types here as needed
    ]);


    return $mimeTypes->search($extension) ?? "File";
}

function GetNameCode($typ =1, $code = 'CRI', $def = 'CRI'){
    $lab = $def;
    if ($typ == 1) {
        $div = Departement::where('code', $code)->first();
        if (!empty($div)) {
            $lab = $div->division;
        }
    }
    if($typ==2){
        $serv = Service::where('code', $code)->first();
        if (!empty($serv)) {
            $lab = $serv->service;
        }

    }

    return $lab;
}

function GetUser($id)
{
    $user = User::find($id);

    return $user->name;
}
