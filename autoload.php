<?php

spl_autoload_register( function($classname) {

    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, strtolower($classname) ); 
    $classpath  = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . "class-".$class . '.php';
    
    if ( file_exists( $classpath) ) {
        include_once $classpath;
    }
   
} );
