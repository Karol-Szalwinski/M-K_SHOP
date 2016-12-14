<?php

/*
 * klasa zamówienia:
 * - składanie nowych zamówień/ edycja zamówienia
 * - wyświetlanie zamównia wg użytkownika/ wszystkich zamówień
 *  co jeszcze ?
 */

class Order {

    private $id;
    private $userId;
    private $status;
    private $creationDate;
    private $paymentMethod;
    private $amount;

    public function __consruct() {
        $this->id = -1;
        $this->userId = 0;
        $this->status = "";
        $this->creationDate = "";
        $this->paymentMethod = "";
        $this->amount = 0;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        if (is_numeric($newId)) {
            $this->id = $newId;
        }
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($newUserId) {
        if (is_numeric($newUserId)) {
            $this->userId = $newUserId;
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($newStatus) {
        if (is_string($newStatus)) {
            $this->status = $newStatus;
        }
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($newCreationDate) {
        if (is_integer($newCreationDate)) {
            $this->creationDate = $newCreationDate;
        }
    }

    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($newPaymentMethod) {
        if (is_string($newPaymentMethod)) {
            $this->paymentMethod = $newPaymentMethod;
        }
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($newAmount) {
        if (is_numeric($newAmount)) {
            $this->amount = $newAmount;
        }
    }

}
