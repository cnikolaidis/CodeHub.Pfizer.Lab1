<?php

    include "Validator.php";

    //CASE 1
//    $data = [ 'name' => 'Marios' ];
//
//    $rules = [ 'name' => 'required' ];
//
//    $messages =
//    [
//        'name' => [ 'required' => 'Name field is a required one']
//    ];

    //CASE 2
//    $data = [];
//
//    $rules = [ 'name' => 'required' ];
//
//    $messages =
//    [
//        'name' => [ 'required' => 'Name field is a required one']
//    ];

    //CASE 3
    $data = [];

    $rules =
    [
        'name' => 'required',
        'email' => ['required', 'email'],
    ];

    $messages =
    [
        'name' => [ 'required' => 'Name field is a required one' ],
        'email' =>
        [
            'required' => 'Email field is a required one',
            'email' => 'Enter a valid email',
        ]
    ];

    $validator = new Validator($data, $rules, $messages);
    $validator->run();

    $success = $validator->isSuccessful();
    if (!$success)
    {
        $errors = $validator->failingRules();
        echo json_encode($errors);
    }
