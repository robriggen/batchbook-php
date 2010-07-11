<?php
/**
 * Big Yellow
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 */

/**
 * Supertag
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 * @copyright   Copyright (c) 2010 Big Yellow Technologies, LLC
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Rob Riggen <rob@bigyellowtech.com>
 */
class Batchblue_Service_BatchBook_Supertag
{
    /**
     * int $_id id of supertag
     */
    private $_id;

    /**
     * string $_name name of supertag
     */
    private $_name;

    /**
     * string $_fields fields of supertag
     */
    private $_fields;

    /**
     * constructor
     *
     * @param int $id optional id of supertag
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
     * Get id of supertag
     *
     * @param null
     * @return int $id id of supertag
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set Id
     *
     * Set id for supertag
     *
     * @param int $value id of supertag
     * @return Batchblue_Service_BatchBook_Supertag
     */
    public function setId($value)
    {
        $this->_id = (integer) $value;

        return $this;
    }

    /**
     * Get Name
     *
     * Get name of supertag
     *
     * @param null
     * @return string $name name of supertag
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Set First Name
     *
     * Set first name of supertag
     *
     * @param string $value first name of supertag
     * @return Batchblue_Service_BatchBook_Supertag
     */
    public function setName($value)
    {
        $this->_name = (string) $value;

        return $this;
    }

}
