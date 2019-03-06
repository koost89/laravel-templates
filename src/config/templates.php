<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model directory
    |--------------------------------------------------------------------------
    |   Where your models are stored. This defaults to 'App'.
    |   If you have your models stored in a different folder you should
    |   edit this value to reflect the directory where your models are stored.
    |   For example if your models are stored in App\Models directory you can
    |   take the following value: App\\Models
    |   Do not forget the extra backslash when using a directory
 */

    'modelPath' => 'App',

    /*
    |--------------------------------------------------------------------------
    | Templates directory
    |--------------------------------------------------------------------------
    |   This is the directory where you would like your directories stored.
    |   This defaults to 'display'.
    |   If you want your directory to store the templates in a different folder,
    |   you can specity it here.
    |   For example if you want it stored in views\templates instead of
    |   views\display you can take the following values: templates
    |
 */

    'templatesPath' => 'display',

    /*
    |--------------------------------------------------------------------------
    | Available view modes
    |--------------------------------------------------------------------------
    | The view modes you would like rendered when you select 'all' on
    | the question which view modes you would like to have rendered.
    | the generated files will be in the following format
    | templatesPath/model/view_mode.blade.php
     */

    'availableViewModes' => [
        'full',
        'teaser',
    ],


];
