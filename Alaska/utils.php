<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 23/08/2018
 * Time: 07:41
 */

function loadClass($className)
{
    require 'class/' . $className . '.php';
}

function errorToException($severity, $message, $file, $line)
{
    throw new ExceptionManager($message, 0, $severity, $file, $line);
}

function customException($exception)
{
    $exception->__toString();

    echo '<section class="exception"><strong>' . $exception->getType() . '</strong> : <span class="Exception-message">' . $exception->getMessage() . '</span><br />Ligne <span class="exception-line">' . $exception->getLine() . '</span> du fichier <span class="exception-file">' . $exception->getFile() . '</span></section>';
}