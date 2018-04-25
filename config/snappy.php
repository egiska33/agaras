<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'timeout' => false,
        'options' => array(
            'page-size' => 'A4',
            'margin-top' => 10,
            'margin-right' => 5,
            'margin-left' => 5,
            'margin-bottom' => 10,
            'header-font-size' => 8,
        ),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
