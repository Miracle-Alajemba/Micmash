<?php

return [

    /*
     * The default QR code generator backend.
     * For example: 'gd', 'imagick', 'svg'
     */
    'default' => 'gd', // <--- Set this to 'gd' manually

    /*
     * The backends that are available for use.
     */
    'back_ends' => [
        'gd' => [
            'driver' => 'gd',
            'size' => 200,
            'color' => [0, 0, 0],
            'background' => [255, 255, 255],
            'margin' => 0,
            'quality' => 90,
        ],
        'imagick' => [
            'driver' => 'imagick',
            'size' => 200,
            'color' => [0, 0, 0],
            'background' => [255, 255, 255],
            'margin' => 0,
            'quality' => 90,
        ],
        'svg' => [
            'driver' => 'svg',
            'size' => 200,
            'color' => '#000000',
            'background' => '#ffffff',
            'margin' => 0,
        ],
    ],

    /*
     * The default output format of the QR code.
     * For example: 'png', 'eps', 'svg'
     */
    'format' => 'png',

    /*
     * The path where the QR codes should be stored.
     */
    'storage_path' => storage_path('app/qrcodes'),

];
