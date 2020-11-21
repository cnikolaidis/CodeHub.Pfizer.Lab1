<?php

class Validator
{
    private $failingRules = [];

    private $data;
    private $rules;
    private $message;

    public function __construct($data, $rules, $message)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->message = $message;
    }

    public function isSuccessful()
    { return count($this->failingRules) < 1; }

    public function failingRules()
    { return $this->failingRules; }

    //Actual Validator
    public function run()
    {
        foreach ($this->rules as $property => $rules)
        {
            if (is_array($rules))
                foreach ($rules as $rule)
                    $this->validateValue($property, $rule);
            else $this->validateValue($property, $rules);
        }
    }

    private function validateValue($property, $rule)
    {
        $errorMessage = $this->message[$property];

        if (!array_key_exists($property, $this->data))
        {
            $this->failingRules[$property] = [ $errorMessage ];
            return;
        }

        $dataValue = $this->data[$property];

        switch ($rule) {
            case 'required':
                if ($this->valueEmpty($dataValue))
                    $this->failingRules[$property] = [$errorMessage];
                break;
            case 'email':
                if ($this->valueValidMail($dataValue))
                    $this->failingRules[$property] = [$errorMessage];
                break;
            case 'integer':
                if ($this->validInt($dataValue))
                    $this->failingRules[$property] = [$errorMessage];
                break;
        }
    }

    private function valueEmpty($n)
    { return empty($n) || $n == null; }

    private function valueValidMail($m)
    {  return $m != null && filter_var($m, FILTER_VALIDATE_EMAIL); }

    private function validInt($v)
    { return is_int($v); }
}