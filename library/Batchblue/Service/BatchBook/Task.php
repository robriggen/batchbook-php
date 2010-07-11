<?php
/**
 * Big Yellow
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 */

/**
 * Task
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 * @copyright   Copyright (c) 2010 Big Yellow Technologies, LLC
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Rob Riggen <rob@bigyellowtech.com>
 */
class Batchblue_Service_BatchBook_Task
{
    /**
     * int $_id id of task
     */
    private $_id;

    /**
     * string $_subject subject of task
     */
    private $_subject;

    /**
     * string $_body body of task
     */
    private $_body;

    /**
     * string $_date date of task
     */
    private $_date;

    /**
     * string $_ctype task type for task
     */
    private $_ctype;

    /**
     * constructor
     *
     * @param int $id optional id of task
     */ 
    public function __construct($id = null)
    {
        if (!empty($id)) {
            $this->setId($id);
        }
    }

    /**
     * Get Id
     *
     * Get id of task
     *
     * @param null
     * @return int $id id of task
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set Id
     *
     * Set id for task
     *
     * @param int $value id of task
     * @return Batchblue_Service_BatchBook_Task
     */
    public function setId($value)
    {
        $this->_id = (integer) $value;

        return $this;
    }

    /**
     * Get Subject
     *
     * Get subject of task
     *
     * @param null
     * @return string $subject subject of task
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * Set Subject
     *
     * Set subject of task
     *
     * @param string $value subject of task
     * @return Batchblue_Service_BatchBook_Task
     */
    public function setSubject($value)
    {
        $this->_subject = (string) $value;

        return $this;
    }

    /**
     * Get Body
     *
     * Get body of task
     *
     * @param string $value body of task
     * @return string
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * Set body of task
     *
     * @param string $value
     * @return Batchblue_Service_BatchBook_Task
     */
    public function setBody($value)
    {
        $this->_body = (string) $value;

        return $this;
    }

    /**
     * Get Date
     *
     * Get date of task
     *
     * @param null
     * @return string $date date of task
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * Set Date
     *
     * Set date for task
     *
     * @param string $value date for task
     * @return Batchblue_Service_BatchBook_Task
     */
    public function setDate($value)
    {
        $this->_date = (string) $value;

        return $this;
    }

    /**
     * Get Ctype
     *
     * Get ctype for task
     *
     * @param null
     * @return string $ctype ctype name
     */
    public function getCtype()
    {
        return $this->_ctype;
    }

    /**
     * Set Ctype
     *
     * Set ctype for task
     *
     * @param string $value ctype for task
     * @return Batchblue_Service_BatchBook_Task
     */
    public function setCtype($value)
    {
        $this->_ctype = (string) $value;

        return $this;
    }

}
