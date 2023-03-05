<?php

namespace Models;

class SendEmail {

    public function confirmRegister($addNom, $addPrenom, $passwordView) {
        /*
            $path           = 'Config/Icons/Cars.png'; // chemin vers le fichier
            $fp             = fopen($path, 'rb');
            $content        = fread($fp, filesize($path));
            fclose($fp);
            $content_encode = chunk_split(base64_encode($content));
        */

        $destinataire = '......@gmail.com';
        $header = "MIME-Version: 1.0\r\n";
        $header.= 'From:"NomDeMonSite"<........@gmail.com>'."\n"; // L'adresse email de l'expéditeur peut être remplacé par une constante dans le fichier "config.php"
        $header.= "Cc: ......@hotmail.com\n";
        $header.= "X-Priority: 1\n";
        $header.= 'Content-Type: text/html; charset="uft-8"'."\n";
        $header.= 'Content-Transfer-Encoding: 8bit';

        $message = '
            <html>
                <body>
                    <div align="center">
                        <img src="https://www.autodiscount.fr/images/voitures/defaut/std/6425-std.png"/>
                        <br />
                        Bonjour, <span style="text-transform:uppercase">' . $addNom . ' ' . $addPrenom . '</span>
                        <br />
                        <br />
                        Votre demande d\'accès au logiciel IMMO_Bile a bien été enregistrée.
                        <br />
                        Votre mot de passe est : ' . $passwordView . '
                        <br />
                        Elle sera validée dans un délai de 24h à 48h.
                        <br />
                        <br />
                        <img src="http://www.primfx.com/mailing/separation.png"/>
                    </div>
                </body>
            </html>';
        /*
            $message .= "Content-Disposition: attachment; filename=\"Cars.png\"\n\n";
            $message .= $content_encode . "\n";
            $message .= "\n\n";
        */

        mail($destinataire, "CONFIRMATION DE RECEPTION DE DEMANDE DE COMPTE SUR ........", $message, $header);
    }

    public function confirmChangePassword($addNom, $addPrenom, $newPassword) {
        // code pour l'envoi d'un email de confirmation de changement de mot de passe
    }

    public function billingReminder($addNom, $addPrenom, $price, $invoiceNumber) {
        // code pour l'envoi d'une relance de facture impayée
    }
}

