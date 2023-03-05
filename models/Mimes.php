<?php

namespace Models;

class Mimes {

    // Génère un tableau avec tous les mime_types
    public function getMimeTypes() {

        $url = "http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types";
        $mimeTypes = [];

        foreach(@explode("\n",@file_get_contents($url)) as $x)
            if(isset($x[0]) && $x[0]!=='#' && preg_match_all('#([^\s]+)#',$x,$out) && isset($out[1]) && ($c=count($out[1]))>1)
                for($i=1;$i<$c;$i++)
                    $mimeTypes[$out[1][$i]] = $out[1][0];
        return $mimeTypes;

        // $mime_types = array(

        //     'txt' => 'text/plain',
        //     'htm' => 'text/html',
        //     'html' => 'text/html',
        //     'php' => 'text/html',
        //     'css' => 'text/css',
        //     'js' => 'application/javascript',
        //     'json' => 'application/json',
        //     'xml' => 'application/xml',
        //     'swf' => 'application/x-shockwave-flash',
        //     'flv' => 'video/x-flv',

        //     // images
        //     'png' => 'image/png',
        //     'jpe' => 'image/jpeg',
        //     'jpeg' => 'image/jpeg',
        //     'jpg' => 'image/jpeg',
        //     'gif' => 'image/gif',
        //     'bmp' => 'image/bmp',
        //     'ico' => 'image/vnd.microsoft.icon',
        //     'tiff' => 'image/tiff',
        //     'tif' => 'image/tiff',
        //     'svg' => 'image/svg+xml',
        //     'svgz' => 'image/svg+xml',

        //     // archives
        //     'zip' => 'application/zip',
        //     'rar' => 'application/x-rar-compressed',
        //     'exe' => 'application/x-msdownload',
        //     'msi' => 'application/x-msdownload',
        //     'cab' => 'application/vnd.ms-cab-compressed',

        //     // audio/video
        //     'mp3' => 'audio/mpeg',
        //     'qt' => 'video/quicktime',
        //     'mov' => 'video/quicktime',

        //     // adobe
        //     'pdf' => 'application/pdf',
        //     'psd' => 'image/vnd.adobe.photoshop',
        //     'ai' => 'application/postscript',
        //     'eps' => 'application/postscript',
        //     'ps' => 'application/postscript',

        //     // ms office
        //     'doc' => 'application/msword',
        //     'rtf' => 'application/rtf',
        //     'xls' => 'application/vnd.ms-excel',
        //     'ppt' => 'application/vnd.ms-powerpoint',

        //     // open office
        //     'odt' => 'application/vnd.oasis.opendocument.text',
        //     'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        // );

        // return $mime_types;


    }
}