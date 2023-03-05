<?php
//On mettra ici les requêtes SQL liées aux articles
namespace Models;

const UPLOADS_DIR = 'assets/uploads/';

// Extensions acceptées par défaut
const FILE_EXT_IMG = ['jpg','jpeg','gif','png'];

class Uploads {

    /** Déplace un fichier transmis dans un répertoire du serveur.
     *
     * @param array     $file           - Contenu du tableau $_FILES du fichier à uploader.
     * @param array     $errors         - Tableau contenant les erreurs. Passage par référence
     * @param string    $dossier        - Dossier dans lequel sera placé le fichier.
     * @param string    $folder         - Chemin absolue ou relatif où le fichier sera déplacé. Par défaut vaut UPLOADS_DIR
     * @param array     $fileExtensions - Tableau d'extensions valident. Par défaut vaut FILE_EXT_IMG.
     *
     * @return string - Le nouveau nom du fichier.
    */
    public function uploadFile( array $file, array &$errors, string $dossier = '', string $folder = UPLOADS_DIR,
                                array $fileExtensions = FILE_EXT_IMG): string {

        $fileName = '';

        // On récupère l'extension du fichier pour vérifier si elle est dans $fileExtensions
        $tmpNameArray = explode(".", $file["name"]);
        $tmpExt = strtolower(end($tmpNameArray));

        // Récupération de la liste des messages d'erreur
        $errorsList = new errorMessages();
        $messagesErrors = $errorsList->getMessages();

        if ($file["error"] === UPLOAD_ERR_OK) {
            $tmpName = $file["tmp_name"];

            if(in_array($tmpExt, $fileExtensions)) {

                // Récupération du tableau contenant tous les mimes
                $model = new Mimes();
                $mimeTypesList = $model->getMimeTypes();

                // On vérifie le contenu de fichier, pour voir s'il appartient aux MIMES autorises.
                if($mimeTypesList[$tmpExt] === mime_content_type($tmpName)) {
                    // On renomme le fichier pour éviter les doublons
                    $fileName = uniqid().'-'.basename($file["name"]);
                    if(!move_uploaded_file($tmpName, $folder.$dossier."/".$fileName)) {
                        $errors[] = $messagesErrors[19];
                    }
                } else {
                    $errors[] = $messagesErrors[20];
                }
            } else{
                $errors[] = $messagesErrors[21];
            }
        }
        else if($file["error"] == UPLOAD_ERR_INI_SIZE || $file["error"] == UPLOAD_ERR_FORM_SIZE) {
            $errors[] = $messagesErrors[22];
        }
        else {
            $errors[] = $messagesErrors[23];
        }
        return $fileName;
    }

    // $avatar = $model->uploadFile($_FILES['userfileAvatar'], $dossier, $errors);
}