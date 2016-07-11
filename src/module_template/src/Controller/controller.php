<?php

namespace {{ vendor_name_u }}\{{ module_name_u }}\Controller;


class {{ module_name_u }}Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    function indexAction()
    {
        return [
            '$view' => [
                'title' => __('{{ module_name_u }}'),
                'name' => '{{ module_name }}:views/index.php'
            ],
            '$data' => [
                'your' => 'data'
            ]
        ];
    }
}