<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//Yii::setPathOfAlias('booster', dirname(__FILE__) . '/../components/booster');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
Yii::setPathOfAlias('highcharts', dirname(__FILE__) . '/../extensions/highcharts');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'PlaVi-Soft',
    // preloading 'log' component
    'preload' => array('log', 'bootstrap'),
    //installing the theme
    'theme' => 'blackboot',
    // 'theme'=>'theme',
    //lenguaje
    'sourceLanguage' => 'es',
    'language' => 'es',
    // autoloading model and component classes
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
    ),
    'import' => array(
        'application.models.*',
        'application.components.*',
        //	     'tablesorter' => 'application.extensions.tablesorter'
        'application.extensions.*',
        'application.extensions.YiiMailer.YiiMailer',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            'generatorPaths' => array('bootstrap.gii.bootstrap'),
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        //'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),
    // application components
    'components' => array(
        'nombre2text' => array(
            'class'=>'application.extensions.number_text.NumberToText',
        ),
        
	/*'booster' => array(
   		 'class' => 'booster.components.Booster',
		),*/
        // formateo de numeros reales
        'format' => array(
            'class'=>'application.components.Formatter',
            'numberFormat' => array('decimals' => 2, 'decimalSeparator' => ',', 'thousandSeparator' => '.'),
            'booleanFormat' => array(Yii::t('app', 'No'), Yii::t('app', 'Si')),
            'datetimeFormat' => 'd/m/Y H:i:s',
            'dateFormat' => 'd/m/Y',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf57.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf',
                /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                /* 'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                  'orientation' => 'P', // landscape or portrait orientation
                  'format'      => 'A4', // format A4, A5, ...
                  'language'    => 'en', // language: fr, en, it ...
                  'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                  'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                  'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                  ) */
                )
            ),
        ),
        'bootstrap' => array(
            //  'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
            'class' => 'bootstrap.components.Bootstrap',
        ),
        /* 'highcharts'=>array(
          //  'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
          'class'=>'highcharts.Highcharts',
          ), */
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         */
        'db' => array(
            //	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
            'connectionString' => 'mysql:host=localhost;dbname=plavisoft',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'mysqlpass',
            'charset' => 'utf8',
        ),
        // uncomment the following to use a MySQL database
        /*
          'db'=>array(
          'connectionString' => 'mysql:host=localhost;dbname=testdrive',
          'emulatePrepare' => true,
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
          ),
         */
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class'=>'CYiiMailerLogRoute',
                    'levels'=>'error',
                    'emails'=>'diegorodriguez.tandil@gmail.com',
                ),
                
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'diego@qwavee.com',
    ),
);
