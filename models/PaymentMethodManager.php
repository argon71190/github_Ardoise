<?php

namespace Models;

use \Models\Database;

class PaymentMethodManager extends Database
{
    public function getAllPaymentMethod() {
        return $this->getAll('SELECT * FROM paymentMethod ORDER BY id ASC');
    }

    public function selectOne($PMName) {
        $sql = 'SELECT * FROM paymentMethod WHERE name = ?';
        return $this->getOne($sql, [$PMName]);
    }

    // *** AJOUTER UN MOYEN DE PAIEMENT
    public function insert(PaymentMethod $paymentMethod): void{

        $datas = [
            'id'    => $paymentMethod->getid(),
            'name'  => $paymentMethod->getName(),
        ];

        $this->addOne('paymentMethod', $datas);
    }

    // *** MODIFICATION DE L'ETAT DU MOYEN DE PAIEMENT
    public function update(Tva $PM): void{

        $newData = [
            'activate'  => $PM->getActivate()
        ];

        $this->updateOne('paymentMethod', $newData, 'id', $PM->getId());
    }

}