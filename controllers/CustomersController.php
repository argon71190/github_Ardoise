<?php

namespace Controllers;

use \App\Router;
use \Models\Customers;
use \Models\CustomersDetails;
use \Models\Country;
use \Models\Valids;
use \Models\CustomersManager;
use \Models\ErrorMessages;
use \Models\ValidMessages;
use \Models\ResultsManager;
use \Models\CodeBarre;

class CustomersController extends Router
{
    public function displayCustomers() {

        $tab1 =[
            [
                'id_ann' => 5,
                'id_user_applicant' => 5,
                'id_service_type' => 1,
                'contents' => "Besoin d'aide pour faire mes courses !",
                'price' => 20,
                'service_date' => '2023-02-25 00:00:00',
                'today_date' => '2023-01-30 14:59:31',
                'activate_ann' => 1,
                'id_user' => 10,
                'lastname' => 'Le Vaillant',
                'firstname' => 'Céline',
                'message' => "Je vous propose mon aide pour faire les courses !",
                'day_date' => '2023-01-31 10:14:59'
            ],
            [
                'id_ann' => 5,
                'id_user_applicant' => 5,
                'id_service_type' => 1,
                'contents' => "Besoin d'aide pour faire mes courses !",
                'price' => 20,
                'service_date' => '2023-02-25 00:00:00',
                'today_date' => '2023-01-30 14:59:31',
                'activate_ann' => 1,
                'id_user' => 21,
                'lastname' => 'ROGER',
                'firstname' => 'Micke',
                'message' => "Je peux faire mieux que Céline, tout sera lustré :-) !",
                'day_date' => '2023-01-31 14:47:49'
            ],
            [
                'id_ann' => 2,
                'id_user_applicant' => 5,
                'id_service_type' => 2,
                'contents' => "Besoin d'aide pour faire le ménage !",
                'price' => 20,
                'service_date' => '2023-02-28 00:00:00',
                'today_date' => '2023-02-28 09:41:55',
                'activate_ann' => 1,
                'id_user' => null,
                'lastname' => null,
                'firstname' => null,
                'message' => null,
                'day_date' => null
            ],
            [
                'id_ann' => 3,
                'id_user_applicant' => 5,
                'id_service_type' => 1,
                'contents' => "Je recherche quelqu'un pour faire mes courses ! Merci !",
                'price' => 20,
                'service_date' => '2023-03-31 00:00:00',
                'today_date' => '2023-01-27 16:20:38',
                'activate_ann' => 1,
                'id_user' => 21,
                'lastname' => 'ROGER',
                'firstname' => 'Micke',
                'message' => "Bonjour, je suis disponible et j'ai un véhicule !",
                'day_date' => '2023-02-01 14:47:49'
            ],
            [
                'id_ann' => 4,
                'id_user_applicant' => 5,
                'id_service_type' => 3,
                'contents' => "Besoin d'aide pour remplir des papiers SVP !",
                'price' => 20,
                'service_date' => '2023-02-28 00:00:00',
                'today_date' => '2023-01-27 16:30:12',
                'activate_ann' => 1,
                'id_user' => null,
                'lastname' => null,
                'firstname' => null,
                'message' => null,
                'day_date' => null
            ]
        ];

var_dump($tab1);

$idAnn = 0;

foreach($tab1 as $elem) {

    if($elem['id_ann'] == $idAnn) {
        if($elem['message'] == null)    var_dump("----> DESOLE, aucune proposition pour cette annonce pour le moment !");
        else                            var_dump("----> VOUS AVEZ RECU UNE PROPOSITION en date du " . $elem['day_date'] . " : Par " . $elem["firstname"] . " " . $elem["lastname"] . " : " . $elem['message']);
    } else {
        var_dump("ANNONCE N°" . $elem['id_ann'] . " : ".$elem['contents']. " (".$elem['price'] . "€) publiée le " . $elem['today_date']);
        var_dump(" *** SERVICE PREVU POUR LE : " . $elem['service_date'] . " ***");
        if($elem['message'] == null)    var_dump("----> DESOLE, aucune proposition pour cette annonce pour le moment !");
        else                            var_dump("----> VOUS AVEZ RECU UNE PROPOSITION en date du " . $elem['day_date'] . " : Par " . $elem["firstname"] . " " . $elem["lastname"] . " : " . $elem['message']);
    }
    $idAnn = $elem['id_ann'];
}

$idAnn = 0;

foreach($tab1 as $elem) {

    if($elem['id_ann'] == $idAnn) {
        // Si message est égal à null : Affichage message --> Pas de proposition
        // Sinon affichage de la proposition
    } else {
        // Affichage de l'annonce'
        // Si message est égal à null : Affichage message --> Pas de proposition
        // Sinon affichage de la proposition
    }
    $idAnn = $elem['id_ann'];
}


// Créer une variable à 0
// boucler sur le tableau avec une foreach
// pour chaque tableau, récupérer l'id de l'annonce
// Si l'id de l'annonce n'est pas égal à ma variable --> Affiche l'annonce + proposition s'il y en a une
// Si l'id de l'annonce est égal à ma variable --> Affiche de la proposition s'il y en a une
// Notre variable prend la valeur de l'id






        $model      = new CustomersManager();
        $customers  = $model->getCustomers();

        $this->render('customers', 'layout', ['customers' => $customers]);
    }

    public function displayOneCustomer($id) {
        $model      = new CustomersManager();
        $find = $model->selectOne('id', $id);

        $customer = new Customers();
            $customer->setLastname($find['lastname']);
            $customer->setFirstname($find['firstname']);
            $customer->setEmail($find['email']);
            $customer->setBirthday($find['birthday']);

        $customerDetails = new CustomersDetails();
            $customerDetails->setAdress($find['adress']);
            $customerDetails->setCp($find['cp']);
            $customerDetails->setCity($find['city']);

        $customerCountry = new Country();
            $customerCountry->setName($find['pays']);

        $customerValids = new Valids();
            $customerValids->setStatut($find['statut']);

        $this->render(
            'customerDetails',
            'layout', [
                'customer'          => $customer,
                'customerDetails'   => $customerDetails,
                'customerValids'    => $customerValids,
                'customerCountry'   => $customerCountry
            ]);
    }

    public function displayFormAddCustomers() {

        //$ifAdmin = new \Models\VerifAdminManager();
        //$ifAdmin->getVerifIfAdmin();

        $model = new ResultsManager();
        $token = $model->genererChaineAleatoire(20);
        $_SESSION['tokenVerify'] = $token;
        //var_dump($_SESSION['token']);

        $this->render('addCustomers', 'layout', ['token' => $token]);
    }

    // ********** ADMINISTRATION **********
    // *** AJOUTER
    public function addCustomer(): void {

        // $ifAdmin = new \Models\VerifAdminManager();
        // $ifAdmin->getVerifIfAdmin(); --> redirection home si la personne n'est pas admin

        $errors = [];
        $valids = [];

        $newCustomer = [
            'lastname'  => '',
            'firstname' => '',
            'birthday'  => '',
            'email'     => '',
            'password'  => '',
            'rfid'      => ''
        ];

        if(    array_key_exists('lastname',     $_POST) && array_key_exists('firstname',    $_POST)
            && array_key_exists('birthday',     $_POST) && array_key_exists('email',        $_POST)
            && array_key_exists('password',     $_POST) && array_key_exists('rfid',         $_POST)
            && array_key_exists('submit',       $_POST) && array_key_exists('token',        $_POST)
            && $_POST['submit'] == "Soumettre" ) {

            $newCustomer = [
                'lastname'  => trim(strtoupper($_POST['lastname'])),
                'firstname' => trim(ucfirst($_POST['firstname'])),
                'birthday'  => trim($_POST['birthday']),
                'email'     => trim(str_replace('+', '', strtolower($_POST['email']))),
                'password'  => trim($_POST['password']),
                'rfid'      => trim($_POST['rfid']),
            ];

            // Récupération de la liste des messages d'erreur
            $errorsList = new errorMessages();
            $messagesErrors = $errorsList->getMessages();

            // Vérification si le formulaire provient bien de notre site
            if(isset($_SESSION['tokenVerify']) && $_SESSION['tokenVerify'] != $_POST['token'])
                $errors[] = $messagesErrors[0];

            // Vérification du champ "Nom"
            if(strlen($newCustomer['lastname']) < 2 || strlen($newCustomer['lastname']) > 50) {
                $errors[] = $messagesErrors[1];
            }else{
                if(preg_match("/[^a-zA-Z]/", $newCustomer['lastname']))
                    $errors[] = $messagesErrors[17];
            }

            // Vérification du champ "Prénom"
            if(strlen($newCustomer['firstname']) < 2 || strlen($newCustomer['firstname']) > 50) {
                $errors[] = $messagesErrors[2];
            }else{
                if(preg_match("/[^a-zA-Z]/", $newCustomer['firstname']))
                $errors[] = $messagesErrors[17];
            }

            // Vérification du champ "Date de naissance"
            $manager = new ResultsManager();
            $BirthdayIsValid = $manager->validateDate($newCustomer['birthday'], 'Y-m-d');
            // $manager->validateDate(...) retourne true si le format de la date de naissance est correct sinon false.

            if(empty($newCustomer['birthday']) || !$BirthdayIsValid) {
                $errors[] = $messagesErrors[3];
            } else{
                $model        = new ResultsManager();
                $dateActuelle = $model->dateNow();

                if($newCustomer['birthday'] >= $dateActuelle) {
                    $errors[] = $messagesErrors[4];
                } else {
                    $am  = explode('/', date('d/m/Y', strtotime($newCustomer['birthday'])));
                    $an  = explode('/', date('d/m/Y', strtotime($dateActuelle)));
                    $age = $an[2] - $am[2] - 1;

                    if(($am[1] < $an[1]) || (($am[1] == $an[1]) && ($am[0] <= $an[0])))
                        $age = $an[2] - $am[2];

                    if($age < 18)
                        $errors[] = $messagesErrors[5];
                }
            }

            // Vérification du champ "Email"
            if(!filter_var($newCustomer['email'], FILTER_VALIDATE_EMAIL))
                $errors[] = $messagesErrors[6];

            // Vérification du champ "Mot de passe"
            if(empty($newCustomer['password']))
                $errors[] = $messagesErrors[7];

            // Vérification du champ "confirmation de mot de passe"
            if($newCustomer['password'] != $_POST['confirm_password'])
                $errors[] = $messagesErrors[8];

            // Vérification que le mot de passe contient bien les caractères requis et le nombre minimal.
            // Soit minimum 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.
            if(!empty($newCustomer['password']) && $newCustomer['password'] === $_POST['confirm_password']){

                $uppercase      = preg_match('@[A-Z]@', $newCustomer['password']);
                $lowercase      = preg_match('@[a-z]@', $newCustomer['password']);
                $number         = preg_match('@[0-9]@', $newCustomer['password']);
                $specialChars   = preg_match('@[^\w]@', $newCustomer['password']);

                if(strlen($newCustomer['password']) < 8)    $errors[] = $messagesErrors[9];
                if(!$uppercase)                             $errors[] = $messagesErrors[10];
                if(!$lowercase)                             $errors[] = $messagesErrors[11];
                if(!$number)                                $errors[] = $messagesErrors[12];
                if(!$specialChars)                          $errors[] = $messagesErrors[13];
            }

            // Si le champ RFID est rempli, on s'assure qu'il n'y a que des chiffres
            if(!empty($newCustomer['rfid'])) {
                if(strlen($newCustomer['rfid']) != 10) {
                    $errors[] = $messagesErrors[14];
                } else {
                    if(preg_match("/[^0-9]/", $newCustomer['rfid']))
                        $errors[] = $messagesErrors[15];
                }
            }

            if(count($errors) == 0) {
                // Vérifier si l'adresse email n'existe pas déjà dans la bdd pour éviter les doublons
                $model              = new CustomersManager();
                $verifExistCustomer = $model->selectOne('email', $newCustomer['email']);

                if(!empty($verifExistCustomer)) {
                    $errors[] = $messagesErrors[16];
                }

                // Aucune erreur dans le formulaire, on peut ajouter le nouveau customers dans la bdd
                $lastname   = $newCustomer['lastname'];
                $firstname  = $newCustomer['firstname'];
                $birthday   = $newCustomer['birthday'];
                $email      = $newCustomer['email'];
                $password   = $newCustomer['password'];
                $rfid       = $newCustomer['rfid'];

                if(count($errors) == 0) {
                    $newCustomer = new Customers();
                    $newCustomer->setLastname($lastname);
                    $newCustomer->setFirstname($firstname);
                    $newCustomer->setBirthday($birthday);
                    $newCustomer->setEmail($email);
                    $newCustomer->setPassword($password);
                    $newCustomer->setRfid($rfid);

                    // Récupération de la liste des messages de validation
                    $validsList = new ValidMessages();
                    $messagesValids = $validsList->getMessages();

                    // Insertion dans la bdd
                    $manager = new CustomersManager();
                    $manager->insert($newCustomer);

                    // Ajout d'un message de validation
                    $valids[] = $messagesValids[2];

                    // Etant donné que je reste sur le formulaire, je regénère un token
                    $model = new ResultsManager();
                    $token = $model->genererChaineAleatoire(20);
                    $_SESSION['tokenVerify'] = $token;

                    $this->render('addCustomers', 'layout', [
                        'newCustomer'   => [],
                        'token'         => $token,
                        'errors'        => $errors,
                        'valids'        => $valids
                    ]);

                    // Inutile de régénérer un token si redirection
                    // header('Location: index.php?page=customers');
                    // exit();
                }
            }
        }

        $model = new ResultsManager();
        $token = $model->genererChaineAleatoire(20);
        $_SESSION['tokenVerify'] = $token;

        $this->render('addCustomers', 'layout', [
            'newCustomer'   => $newCustomer,
            'token'         => $token,
            'errors'        => $errors,
            'valids'        => $valids
        ]);
    }






















/*
try
    {

    }
    catch(PDOException $e)
    {
        $view = 'error';
        $errors[] = 'Une erreur de connexion a eu lieu :'.$e->getMessage();
    }


    public function displayChats() {
        $categoriesModel = new Category();
        $roomModel       = new Room();
        $categories      = $categoriesModel->getCategories();
        $roomsByCat      = [];

        foreach( $categories as $category ) {
            $roomsByCat[ $category['name'] ] = $roomModel->getRoomsByCat( $category['id'] );
        }

        if( isset( $_GET['roomid'] ) && !empty( $_GET['roomid'] ) ) {
            $messageModel = new Message();
            $currentRoom = $roomModel->getRoomById( $_GET['roomid'] );
            $messages = $messageModel->getRoomMessagesOrderByDateAsc( $_GET['roomid'] );
        }
        else {
            $messages = [];
        }

        $this->render(
            'chats',
            'layout',
                [   'categories'    => $categories,
                    'roomsByCat'    => $roomsByCat,
                    'currentRoom'   => $currentRoom,
                    'messages'      => $messages
                ]
        );
    }

    public function displayCategoryForm() {
        $this->render( 'newCategory', 'layout' );
    }

    public function displayRoomForm() {
        $categoriesModel = new Category();
        $categories = $categoriesModel->getCategories();
        $this->render(
            'newRoom',
            'layout',
                [   'categories' => $categories
            ]
        );
    }*/
}