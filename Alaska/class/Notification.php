<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 27/08/2018
 * Time: 05:51
 */

class Notification
{
    private $_message = "";
    private $_type;

    public function __construct($message, $type = E_ERROR)
    {
        $this->_message = (string) $message;

        switch($type)
        {
            case E_ERROR:
                $this->setType('Erreur');
                break;
            case E_NOTICE:
                $this->setType('Information');
                break;
            default:
                $this->setType('Inconnu');
                break;
        }
    }

    public function getType()
    {
        return $this->_type;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->_message = (string) $message;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = (string) $type;
    }

    /**
     * @return string
     */
    public function show()
    {
        return '<section class="error-user"><span class="error-user-type">' . $this->getType() . '</span> : <span class="error-user-message">' . $this->getMessage() . '</span></section>';
    }
}