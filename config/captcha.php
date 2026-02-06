<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'],
    'default' => [
        'length' => 5,
        'width' => 150,
        'height' => 40,
        'quality' => 90,
        'math' => false,
        'expire' => 60,
        'encrypt' => false,
        'lines' => 3,
        'bgImage' => false,
        'bgColor' => '#ecf2f4',
        'fontColors' => ['#2c3e50', '#c0392b', '#16a085',  '#8e44ad'],
        'contrast' => 0,
        'sensitive' => false,
        'angle' => 0,
        'sharpen' => 0,
        'blur' => 0,
        'invert' => false,
     
    ],
   

    'flat' => [
        'length' => 5,
        'width' => 150,
        'height' => 40,
        'quality' => 90,
        'lines' => 3,
        'bgImage' => false,
        'bgColor' => '#ecf2f4',
        'fontColors' => ['#2c3e50', '#c0392b', '#16a085',  '#8e44ad'],
        'contrast' => 0,
    ],
    
];
