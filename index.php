<?php

interface IHuman
{
    function getFirstName();
    function getLastName();
    function setFirstName($fn);
    function setLastName($ln);
}

class Human implements IHuman
{
    protected $firstName;
    protected $lastName;

    public function getFirstName()
    { return $this->firstName; }

    public function getLastName()
    { return $this->lastName; }

    public function setFirstName($fn)
    { $this->firstName = $fn; }

    public function setLastName($ln)
    { $this->lastName = $ln; }
}

class Customer extends Human {}

$customer = new Customer();
$customer->setFirstName("Michael");
$customer->setLastName("Jackson");

echo "First Name: {$customer->getFirstName()}<br>";
echo "Last Name: {$customer->getLastName()}";

?>