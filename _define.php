<?php

/**
 * @brief CustomElement, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
$this->registerModule(
    'Custom HTML Element',
    'Custom HTML Element for Dotclear server',
    'Franck Paul',
    '0.1',
    [
        'date'        => '2025-09-07T16:10:22+0200',
        'requires'    => [['core', '2.36']],
        'permissions' => 'My',
        'type'        => 'plugin',

        'details'    => 'https://open-time.net/?q=CustomElement',
        'support'    => 'https://github.com/franck-paul/CustomElement',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/CustomElement/main/dcstore.xml',
        'license'    => 'gpl2',
    ]
);
