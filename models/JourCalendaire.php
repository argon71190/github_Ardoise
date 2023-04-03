<?php
namespace Models;

class JourCalendaire {

    // Deux constructeurs dans cette classe, si le quatrième paramètre est nul => année, mois, jour.
    // Si le quatrième paramètre n'est pas nul, alors année, numero de jour.
    // Exemple
    /*
       
       $d1 = new JourCalendaire('2023','03','26');
       $d2 = new JourCalendaire('2023', '03', '26', '231');

       echo $d1->getNomDateMois() . PHP_EOL;
       echo $d1->getNomDateMoisAnnee() . PHP_EOL;
       echo $d2->getNomDateMois() . PHP_EOL;
       echo $d2->getNomDateMoisAnnee() . PHP_EOL;
       
     */

    private DateTime $jour;

    private IntlDateFormatter $nomJourSemaine;
    private IntlDateFormatter $nomDateMois;
    private IntlDateFormatter $nomDateMoisAnnee;

    public function __construct(private string $aaaa, private string $mm, private string $jj, private ?string $numeroJour=null){
	$this->jour = $this->initialisations([$this->aaaa, $this->mm, $this->jj, $this->numeroJour]);
	$this->nomJourSemaine = new IntlDateFormatter("fr_FR", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'EEEE');
	$this->nomDateMois = new IntlDateFormatter("fr_FR", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'EEEE d MMMM');
	$this->nomDateMoisAnnee = new IntlDateFormatter("fr_FR", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Europe/Paris', IntlDateFormatter::GREGORIAN, 'EEEE d MMMM Y');
    }

    private function initialisations(array $envoi): DateTime {
	// Si les valeurs contenues dans le tableau ne permettent pas de créer l'objet DateTimeimmutable
	// alors création d'un objet DateTime par défaut, à savoir, à la date du jour.
	$retour;
	
	$aaaa = $envoi[0];
	$mm = $envoi[1];
	$jj = $envoi[2];
	$numeroJour = $envoi[3];

	// Deux possibilités : création d'un objet DateTime
	// -> à partir de année, mois, jour : par exemple 2023 03 26 <=> 26 mars 2023
	// -> à partir de année et numéro de jour de l'année : par exemple 2023 231 <=> 20 août 2023, 231ème jour de l'année.

	try {
	    $retour = is_null($numeroJour) ?
		      DateTime::createFromFormat('Y-m-d', implode('-', [$aaaa, $mm, $jj]))
		    : DateTime::createFromFormat('Y z', $aaaa . ' ' . $numeroJour);   
	    $retour->setTimeZone(new DateTimeZone('Europe/Paris'));
	}
	catch(Exception $exception){
	    $retour = new DateTime('now', new DateTimeZone('Europe/Paris'));	    
	}
	return $retour;
    }

    public function getDateTime(): DateTime {
	// Objet DateTime
	return $this->jour;
    }

    public function getNumeroJour(): int {
	// version numérique du jour: de 0 à 366
	return intval(($this->jour)->format('z'));
    }

    public function getJour(): int {
	// jour : 1 -> 31
	return intval(($this->jour)->format('d'));
    }
    
    public function getMois(): int {
	// mois : 1 -> 12
	return intval(($this->jour)->format('m'));
    }
    
    public function getAnnee(): int {
	// Année en quatre chiffres
	//return $this->annee;
	return intval(($this->jour)->format('Y'));
    }

    public function getNumeroJourAnnee(): array {
	// tableau contenant le numéro du jour et l'année
	return [$this->getNumeroJour(), $this->getAnnee()];
    }

    public function getNomJour(): string {
	// Nom du jour en français
	return $this->nomJourSemaine->format($this->jour);	
    }

    public function getNomDateMois(): string{
	// dimanche 26 mars
	return $this->nomDateMois->format($this->jour);	
    }

    public function getNomDateMoisAnnee(): string{
	// dimanche 26 mars 2023
	return $this->nomDateMoisAnnee->format($this->jour);	
    }

    public function weekend_p(): bool {
	//est-ce un samedi ou un dimanche
	return preg_match('/samedi|dimanche/', $this->getNomJour()) ;
    }

    public function getHeure(): string {	
	return ($this->jour)->format('H:i:s');
    }

    public function getHeures(): int {
	return intval(($this->jour)->format('h'));
    }

    public function getMinutes(): int {
	return intval(($this->jour)->format('i'));
    }

    public function getSecondes(): int {
	return intval(($this->jour)->format('s'));
    }

    public function __toString(): string{
	return $this->jour->format('Y-z');
    }

}
