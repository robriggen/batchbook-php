<?php
/**
 * Big Yellow
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 */

/**
 * Task Service
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 */
class Batchblue_Service_BatchBook_TaskService
{
    /**
     * @var string
     */
    private $_accountName;

    /**
     * @var string
     */
    private $_token;

    /**
     * Construct new Task Service
     *
     * @param string $token
     */
    public function __construct($accountName, $token)
    {
        $this->_accountName = (string) $accountName;
        $this->_token = (string) $token;
    }

    /**
     * Create Task From XML
     *
     * @param SimpleXMLElement $xmlElement
     * @return Batchblue_Service_BatchBook_Task
     */
    private function _populateTaskFromXmlElement(
        SimpleXMLElement $xmlElement,
        Batchblue_Service_BatchBook_Task $task = null
    )
    {
        if (null === $task) {
            $task = new Batchblue_Service_BatchBook_Task();
        }
        $task
            ->setId($xmlElement->id)
            ->setSubject($xmlElement->subject)
            ->setBody($xmlElement->body)
            ->setDate($xmlElement->date)
            ->setCtype($xmlElement->ctype)
        ;
        return $task;
    }

    /**
     * Index Of Tasks
     *
     * @param string $name
     * @param string $email
     * @param integer $offset
     * @param integer $limit
     * @return array
     */
    public function indexOfTasks($contact_id = null, $ctype = null, $offset = null, $limit = null)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/tasks.xml'
        );
        if (null !== $contact_id) {
            $httpClient->setParameterGet('contact_id', $contact_id);
        }
        if (null !== $ctype) {
            $httpClient->setParameterGet('ctype', $ctype);
        }
        if (null !== $offset) {
            $httpClient->setParameterGet('offset', $offset);
        }
        if (null !== $limit) {
            $httpClient->setParameterGet('limit', $limit);
        }
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::GET);
        $xmlResponse = simplexml_load_string($response->getBody());
        $tasks = array();
        foreach ($xmlResponse->task as $taskElement) {
            $tasks[] = $this->_populateTaskFromXmlElement($taskElement);
        }
        return $tasks;
    }

    /**
     * Get Task
     *
     * @param integer $id
     * @return Batchblue_Service_BatchBook_Task
     */
    public function getTask($id)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/tasks/' . $id . '.xml'
        );
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::GET);
        switch ($response->getStatus()) {
            case 200:
                break;
            case 404:
                return null;
                break;
            default;
                //TODO: throw more specific exception
                throw new Exception('Could not get Task.');
        }
        $xmlResponse = simplexml_load_string($response->getBody());
        return $this->_populateTaskFromXmlElement($xmlResponse);
    }

    /**
     * Post Task
     *
     * @param Batchblue_Service_BatchBook_Task $task
     * @return Batchblue_Service_BatchBook_TaskService   Provides a fluent interface
     */
    public function postTask(Batchblue_Service_BatchBook_Task $task)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/tasks.xml'
        );
        $httpClient->setParameterPost(
            'task[subject]',
            $task->getSubject()
        );
        $httpClient->setParameterPost(
            'task[body]',
            $task->getBody()
        );
        $httpClient->setParameterPost(
            'task[date]',
            $task->getDate()
        );
        $httpClient->setParameterPost(
            'task[ctype]',
            $task->getCtype()
        );
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::POST);
        if (201 != $response->getStatus()) {
            //TODO: throw more specific exception
            throw new Exception('Task not created.');
        }
        $location = $response->getHeader('location');
        $httpClient = new Zend_Http_Client($location);
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::GET);
        $xmlResponse = simplexml_load_string($response->getBody());
        $this->_populateTaskFromXmlElement($xmlResponse, $task);
        return $this;
    }

    /**
     * Put Task
     *
     * @param Batchblue_Service_BatchBook_Task $task
     * @return Batchblue_Service_BatchBook_TaskService   Provides a fluent interface
     */
    public function putTask(Batchblue_Service_BatchBook_Task $task)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/tasks/' . $task->getId() . '.xml'
        );
        $paramsPut = array(
            'task[subject]'    => $task->getSubject(),
            'task[body]'     => $task->getBody(),
            'task[date]'         => $task->getDate(),
            'task[ctype]'       => $task->getCtype(),
        );
        $httpClient->setAuth($this->_token, 'x');
        $httpClient->setHeaders(
            Zend_Http_Client::CONTENT_TYPE,
            Zend_Http_Client::ENC_URLENCODED
        );
        $httpClient->setRawData(
            http_build_query($paramsPut, '', '&'),
            Zend_Http_Client::ENC_URLENCODED
        );
        $response = $httpClient->request(Zend_Http_Client::PUT);
        if (200 != $response->getStatus()) {
            //TODO: throw more specific exception
            throw new Exception('Task not updated.');
        }
        return $this;
    }

    /**
     * Delete Task
     *
     * @param Batchblue_Service_BatchBook_Task $task
     * @return Batchblue_Service_BatchBook_TaskService   Provides a fluent interface
     */
    public function deleteTask(Batchblue_Service_BatchBook_Task $task)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/tasks/' . $task->getId() . '.xml'
        );
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::DELETE);
        if (200 != $response->getStatus()) {
            //TODO: throw more specific exception
            throw new Exception('Task not deleted.');
        }
        return $this;
    }
}
