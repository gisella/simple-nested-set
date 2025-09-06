<?php

spl_autoload_register('autoload');

function autoload($class)
{
    if (strpos($class, 'NestedSet') !== false) {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = realpath(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php');
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
class Ak_Error {
    static function log_error($num, $str, $file, $line, $context = null) {
        if($num == E_STRICT) return;
        if($num == E_CORE_ERROR) return;
        if($num == E_CORE_WARNING) return;
        self::log_exception ( new ErrorException ( $str, $num, $num, $file, $line ) );
    }

    static function log_exception(Exception $e) {
        print "<div style='text-align: center;'>";
        print "<h2 style='color: rgb(190, 50, 50);'>Exception Occured:</h2>";
        print "<table style='width: 800px; display: inline-block;'>";
        print "<tr style='background-color:rgb(230,230,230);'><th style='width: 80px;'>Type</th><td>" . $e->getCode() . "</td></tr>";
        print "<tr style='background-color:rgb(240,240,240);'><th>Message</th><td>{$e->getMessage()}</td></tr>";
        print "<tr style='background-color:rgb(230,230,230);'><th>File</th><td>{$e->getFile()}</td></tr>";
        print "<tr style='background-color:rgb(240,240,240);'><th>Line</th><td>{$e->getLine()}</td></tr>";
        print "</table></div>";

        $errore='Errore '. $e->getCode().' in '.$e->getFile().' ('.$e->getLine().")\r\n";
        $errore.="\t\t".$e->getMessage()."\r\n\r\n";
        error_log($errore);
        file_put_contents('/tmp/log.txt', $errore);
    }

    static function check_for_fatal() {
        $error = error_get_last ();
        if(!$error) return;
        self::log_error ( $error ["type"], $error ["message"], $error ["file"], $error ["line"] );
    }
}
register_shutdown_function ('Ak_Error::check_for_fatal');
set_error_handler ('Ak_Error::log_error');
set_exception_handler ('Ak_Error::log_exception');
