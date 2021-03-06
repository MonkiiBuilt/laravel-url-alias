<?php
/**
 * @author Jonathon Wallen
 * @date 10/4/17
 * @time 1:25 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

return [

    /**
     *
     */
    'defaultSystemPath' => 'pages/',

    'menu' => [
        'main' => [
            'laravel-administrator-url-alias' => [
                'label' => 'Url Redirects',
                'classes' => [],
                'children' => [
                    'laravel-administrator-url-alias-create',
                    'laravel-administrator-url-alias-edit',
                ]
            ]
        ]
    ]
];