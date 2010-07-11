<?php
/**
 * Big Yellow
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 */

/**
 * Todo
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 * @copyright   Copyright (c) 2010 Big Yellow Technologies, LLC
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Rob Riggen <rob@bigyellowtech.com>
 */
class Batchblue_Service_BatchBook_Todo
{
    /**
     * int $_id id of todo
     */
    private $_id;

    /**
     * string $_title title of todo
     */
    private $_title;

    /**
     * string $_description description of todo
     */
    private $_description;

    /**
     * string $_due_date due date of todo
     */
    private $_due_date;

    /**
     * string $_flagged flagged for todo
     */
    private $_flagged;

    /**
     * string $_complete complete for todo
     */
    private $_complete;

    /**
     * constructor
     *
     * @param int $id optional id of todo
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
     * Get id of todo
     *
     * @param null
     * @return int $id id of todo
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set Id
     *
     * Set id for todo
     *
     * @param int $value id of todo
     * @return Batchblue_Service_BatchBook_Todo
     */
    public function setId($value)
    {
        $this->_id = (integer) $value;

        return $this;
    }

    /**
     * Get Title
     *
     * Get title of todo
     *
     * @param null
     * @return string $title title of todo
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Set Title 
     *
     * Set title of todo
     *
     * @param string $value title of todo
     * @return Batchblue_Service_BatchBook_Todo
     */
    public function setTitle($value)
    {
        $this->_title = (string) $value;

        return $this;
    }

    /**
     * Get Description
     *
     * Get description of todo
     *
     * @param string $value description of todo
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Set description of todo
     *
     * @param string $value
     * @return Batchblue_Service_BatchBook_Todo
     */
    public function setDescription($value)
    {
        $this->_description = (string) $value;

        return $this;
    }

    /**
     * Get Due Date
     *
     * Get due date of todo
     *
     * @param null
     * @return string $due_date due date of todo
     */
    public function getDueDate()
    {
        return $this->_due_date;
    }

    /**
     * Set Due Date
     *
     * Set due date for todo
     *
     * @param string $value due date for todo
     * @return Batchblue_Service_BatchBook_Todo
     */
    public function setDueDate($value)
    {
        $this->_due_date = (string) $value;

        return $this;
    }

    /**
     * Get Flagged
     *
     * Get flagged for todo
     *
     * @param null
     * @return string $flagged flagged name
     */
    public function getFlagged()
    {
        return $this->_flagged;
    }

    /**
     * Set Flagged
     *
     * Set flagged for todo
     *
     * @param string $value flagged for todo
     * @return Batchblue_Service_BatchBook_Todo
     */
    public function setFlagged()
    {
        return $this->_flagged;
    }

    /**
     * Get Complete
     *
     * Get complete for todo
     *
     * @param null
     * @return string $complete complete name
     */
    public function getComplete()
    {
        return $this->_complete;
    }

    /**
     * Set Complete
     *
     * Set complete for todo
     *
     * @param string $value complete for todo
     * @return Batchblue_Service_BatchBook_Todo
     */
    public function setComplete($value)
    {
        $this->_complete = (string) $value;

        return $this;
    }

}
