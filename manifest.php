<?php

$manifest = array(
    'acceptable_sugar_flavors' => array('PRO', 'ENT', 'ULT'),
    'acceptable_sugar_versions' => array(
        'exact_matches' => array(),
        'regex_matches' => array(
            0 => '8\\.(.*?)\\.(.*?)',
            1 => '9\\.0\\.(.*?)\\.(.*?)',
            2 => '10\\.0\\.(.*?)\\.(.*?)',
            3 => '11\\.0\\.(.*?)\\.(.*?)',
        ),
        'author' => 'SugarCRM',
        'description' => 'Installs the Timer field into your sugarcrm instance',
        'icon' => '',
        'is_uninstallable' => true,
        'name' => 'Timer Field Installer',
        'published_date' => '2021-03-26 08:00:00',
        'type' => 'module',
        'version' => '1',
    ),
);

$installdefs = array(
    'id' => 'package_timer_1',

    'copy' => array(
        array(
            'from' => '<basepath>/custom/clients/base/fields/timer/timer.js',
            'to' => 'custom/clients/base/fields/timer/timer.js',
        ),
        array(
            'from' => '<basepath>/custom/clients/base/fields/timer/edit.hbs',
            'to' => 'custom/clients/base/fields/timer/edit.hbs',
        ),
        array(
            'from' => '<basepath>/custom/clients/base/fields/timer/detail.hbs',
            'to' => 'custom/clients/base/fields/timer/detail.hbs',
        ),
        array(
            'from' => '<basepath>/custom/clients/base/fields/timer/preview.hbs',
            'to' => 'custom/clients/base/fields/timer/preview.hbs',
        ),
        array(
            'from' => '<basepath>/custom/Extension/modules/ModuleBuilder/Ext/Language/en_us.timerfield.php',
            'to' => 'custom/Extension/modules/ModuleBuilder/Ext/Language/en_us.timerfield.php',
        ),
        array(
            'from' => '<basepath>/custom/Extension/modules/DynamicFields/Ext/Language/en_us.timerfield.php',
            'to' => 'custom/Extension/modules/DynamicFields/Ext/Language/en_us.timerfield.php',
        ),
        array(
            'from' => '<basepath>/custom/include/SugarFields/Fields/Timer/SugarFieldTimer.php',
            'to' => 'custom/include/SugarFields/Fields/Timer/SugarFieldTimer.php',
        ),
        array(
            'from' => '<basepath>/custom/modules/DynamicFields/templates/Fields/Forms/timer.php',
            'to' => 'custom/modules/DynamicFields/templates/Fields/Forms/timer.php',
        ),
        array(
            'from' => '<basepath>/custom/modules/DynamicFields/templates/Fields/Forms/timer.tpl',
            'to' => 'custom/modules/DynamicFields/templates/Fields/Forms/timer.tpl',
        ),
        array(
            'from' => '<basepath>/custom/modules/DynamicFields/templates/Fields/Templatetimer.php',
            'to' => 'custom/modules/DynamicFields/templates/Fields/Templatetimer.php',
        ),
    ),
);
