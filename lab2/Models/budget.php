<?php

namespace models;

class Budget {

    private $budget_name;
    private $budget_amount;


    public function getBudgetName() {
        return $this->budget_name;
    }

    public function setBudgetName($budget_name) {
        $this->budget_name = $budget_name;
    }

    public function getBudgetAmount() {
        return $this->budget_amount;
    }

    public function setBudgetAmount($budget_amount) {
        $this->budget_amount = $budget_amount;
    }

    public function __construct($budget_name, $budget_amount) {
        $this->budget_name = $this->validateInput($budget_name);
        $this->budget_amount = $this->validateBudgetAmount($budget_amount) ? $budget_amount : 0;
    }

    // Function to validate user input
    function validateInput($data) {
        // Trim whitespace from the beginning and end of the input
        $data = trim($data);
        // Remove backslashes from the input
        $data = stripslashes($data);
        // Convert special characters to HTML entities
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to validate budget amount
    function validateBudgetAmount($amount) {
        if (!is_numeric($amount)) {
            return false;
        }
        if ($amount <= 0) {
            return false; 
        }
        return true;
    }
}
?>