<?php

namespace Models;

const PATH = "assets/codes_barres/";

class CodeBarre {

    /** Créé d'un code barre sous forme d'une image.
     *
     * @param string    $code_txt       - Code à 13 chiffres.
     * @param int       $code_hgt       - Hauteur du code a barre.
     * @param int       $code_ttx       - Affichage du texte en dessous ( 0 = pas affiché, 1 = affiché ).
     * @param int       $code_width     - Taille du code à barres de 1.
     * @param string    $way            - Chemin de stockage de l'image code barre créee.
     *
     * @return string - Nom de l'image créé.
     *
     *  $model          = new CodeBarre();
     *  $imgCodeBarre   = $model->generate(1234561234567);
    */
    public function generate(string $code_txt = "", int $code_hgt = 80, int $code_ttx = 1, int $code_width = 1, string $way = PATH) {

        if ($code_txt) {
            putenv('GDFONTPATH='.realpath('.'));

            // Récupération des tableaux de code pour la création du code barre
            $arrayList  = new arrayCodeBarre();
            $array      = $arrayList->getArray();
            $tab        = $array[0];
            $tab2       = $array[1];
            $tab3       = $array[2];

            $barcsum    = 104;
            $barcode    = $tab['104'];
            $code_txt   = str_replace(' ', '£', $code_txt);
            $caractere  = explode('¤',wordwrap($code_txt, 1, '¤', 1));
            $size_cara  =sizeof($caractere);

            $j = 0;
            for($i = 0; $i < $size_cara; $i++) {
                $j++;
                $barcode.= $tab[$tab3[$caractere[$i]]];
                $barcsum+= $tab3[$caractere[$i]] * $j;
            }

            $barcsum             = fmod($barcsum, 103);
            $barcode            .= $tab[$barcsum];
            $barcode            .= $tab['106'];
            $font_taille         = 5;
            $barcode_longueur    = 2;
            $nb                  = strlen($barcode);

            for($j = 0; $j < $nb; $j++) {
                $barcode_longueur += substr($barcode, $j, 1) * $code_width;
            }

            $im = imagecreate($barcode_longueur - 2, $code_hgt);

            $COL_White      = imagecolorallocate($im, 255, 255, 255);
            $COL_Black      = imagecolorallocate($im, 0, 0, 0);
            $font_hauteur   = imagefontheight($font_taille);
            $font_largeur   = imagefontwidth($font_taille);

            if ($code_ttx == true) {
                $code_hgt = $code_hgt - $font_hauteur;
            }

            $xpos       = 0;
            $caractere  = explode('¤',wordwrap($barcode, 6, '¤', 1));
            $size_cara  = sizeof($caractere);

            for($i = 0; $i < $size_cara; $i++) {
                $COLOR  = $COL_Black;
                $nb     = strlen($caractere[$i]);

                for($j = 0; $j < $nb; $j++) {
                    $TMP_CODE = substr($caractere[$i], $j, 1);
                    for($lngj = 0; $lngj < $TMP_CODE * $code_width; $lngj++) {
                        imageline($im, $xpos, 0, $xpos, $code_hgt, $COLOR);
                        $xpos++;
                    }
                    if($COLOR != $COL_Black) {
                        $COLOR = $COL_Black;
                    }else{
                        $COLOR = $COL_White;
                    }
                }
            }
            if ($code_ttx == true) {
                $code_txt = str_replace('£',' ', $code_txt);
                imagestring($im, $font_taille,($barcode_longueur - $font_largeur * strlen($code_txt))/2, $code_hgt, $code_txt, $COL_Black);
            }

            imagejpeg($im, $way . $code_txt.".jpg");
            // header('Content-type: image/gif');
            // imagegif($im);
            // imagedestroy($im);
            return $code_txt . ".jpg";
        }
    }
}