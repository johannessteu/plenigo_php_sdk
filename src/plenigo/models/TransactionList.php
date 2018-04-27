<?php

namespace plenigo\models;

require_once __DIR__ . '/IterableBase.php';
require_once __DIR__ . '/Transaction.php';

/**
 * <p>
 * This class constitutes the data resulting from the getCompanyUsers call. 
 * This implementas Iterator so it can be userd in a foreach statement
 * </p>
 */
class TransactionList extends IterableBase {

    private $pageNumber = 0;
    private $size = 10;
    private $totalElements = 0;
    private $startDate = null;
    private $endDate = null;

    /**
     * Private constructor for the TransactionList
     * 
     * @param array $array The array of Transaction elements if any
     * @param int $pageNumber The Page number  (starting from 0)
     * @param int $size The Size of the page (minimum 10, maximum 100)
     * @param int $totalElements The Size of the entire result set
     * @param int $startDate The start date of the resulting list
     * @param int $endDate The end date of the resulting list
     */
    private function __construct($array, $pageNumber = 0, $size = 10, $totalElements = 0, $startDate = null, $endDate = null) {
        if (is_array($array)) {
            $this->elements = $array;
        }
        $this->pageNumber = $pageNumber;
        $this->size = $size;
        $this->totalElements = $totalElements;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getPageNumber() {
        return $this->pageNumber;
    }

    public function getSize() {
        return $this->size;
    }

    public function getElements() {
        return $this->elements;
    }

    public function getTotalElements() {
        return $this->totalElements;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    /**
     * Creates a TransactionList instance from an array map.
     *
     * @param array $map The array map to use for the instance creation.
     *
     * @return TransactionList instance.
     */
    public static function createFromMap(array $map) {
        $pageNumber = isset($map['pageNumber']) ? $map['pageNumber'] : 0;
        $size = isset($map['size']) ? $map['size'] : 10;
        $totalElements = isset($map['totalElements']) ? $map['totalElements'] : 0;
        $startDate = isset($map['startDate']) ? $map['startDate'] : null;
        $endDate = isset($map['endDate']) ? $map['endDate'] : null;

        $arrElements = isset($map['elements']) ? $map['elements'] : array();
        $arrResulting = array();
        foreach ($arrElements as $cpnyTransaction) {
            $transaction = Transaction::createFromMap((array) $cpnyTransaction);
            array_push($arrResulting, $transaction);
        }

        return new TransactionList($arrResulting, $pageNumber, $size, $totalElements, $startDate, $endDate);
    }

}
