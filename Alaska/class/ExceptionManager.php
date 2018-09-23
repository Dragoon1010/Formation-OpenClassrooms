<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 27/08/2018
 * Time: 03:41
 */

spl_autoload_register('loadClass');

class ExceptionManager extends ErrorException
{
    protected $severity;
    private $_type = "Erreur inconnu";

    public function __construct($message, $code = 0, $severity)
    {
        parent::__construct($message, $code, $severity);
    }

    public function __toString()
    {
        switch($this->severity)
        {
            case E_USER_ERROR :
                $this->_type = "Erreur fatale";
                break;
            case E_WARNING :
            case E_USER_WARNING :
                $this->_type = "Attention";
                break;
            case E_NOTICE :
            case E_USER_NOTICE :
                $this->_type = "Information";
                break;
            default :
                $this->_type = 'Erreur inconnu';
                break;
        }

        return $this->_type . ' : [' . $this->getCode() . '] ' . $this->getMessage() . $this->getFile() . ' à la ligne ' . $this->getLine();
    }

    public function getType()
    {
        return $this->_type;
    }
}

