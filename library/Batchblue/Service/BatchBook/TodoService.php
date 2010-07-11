<?php
/**
 * Big Yellow
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 */

/**
 * Todo Service
 *
 * @category    Batchblue
 * @package     Batchblue_Service
 * @subpackage  BatchBook
 */
class Batchblue_Service_BatchBook_TodoService
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
     * Construct new Todo Service
     *
     * @param string $token
     */
    public function __construct($accountName, $token)
    {
        $this->_accountName = (string) $accountName;
        $this->_token = (string) $token;
    }

    /**
     * Create Todo From XML
     *
     * @param SimpleXMLElement $xmlElement
     * @return Batchblue_Service_BatchBook_Todo
     */
    private function _populateTodoFromXmlElement(
        SimpleXMLElement $xmlElement,
        Batchblue_Service_BatchBook_Todo $todo = null
    )
    {
        if (null === $todo) {
            $todo = new Batchblue_Service_BatchBook_Todo();
        }
        $todo
            ->setId($xmlElement->id)
            ->setTitle($xmlElement->title)
            ->setDescription($xmlElement->description)
            ->setDueDate($xmlElement->due_date)
            ->setFlagged($xmlElement->flagged)
            ->setComplete($xmlElement->complete)
        ;
        return $todo;
    }

    /**
     * Index Of Todos
     *
     * @param void
     * @return array
     */
    public function indexOfTodos()
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/todos.xml'
        );
        /*
        if (null !== $limit) {
            $httpClient->setParameterGet('limit', $limit);
        }
         */
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::GET);
        $xmlResponse = simplexml_load_string($response->getBody());
        $todos = array();
        foreach ($xmlResponse->todo as $todoElement) {
            $todos[] = $this->_populateTodoFromXmlElement($todoElement);
        }
        return $todos;
    }

    /**
     * Get Todo
     *
     * @param integer $id
     * @return Batchblue_Service_BatchBook_Todo
     */
    public function getTodo($id)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/todos/' . $id . '.xml'
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
                throw new Exception('Could not get Todo.');
        }
        $xmlResponse = simplexml_load_string($response->getBody());
        return $this->_populateTodoFromXmlElement($xmlResponse);
    }

    /**
     * Post Todo
     *
     * @param Batchblue_Service_BatchBook_Todo $todo
     * @return Batchblue_Service_BatchBook_TodoService   Provides a fluent interface
     */
    public function postTodo(Batchblue_Service_BatchBook_Todo $todo)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/todos.xml'
        );
        $httpClient->setParameterPost(
            'todo[title]',
            $todo->getTitle()
        );
        $httpClient->setParameterPost(
            'todo[description]',
            $todo->getDescription()
        );
        $httpClient->setParameterPost(
            'todo[due_date]',
            $todo->getDueDate()
        );
        $httpClient->setParameterPost(
            'todo[flagged]',
            $todo->getFlagged()
        );
        $httpClient->setParameterPost(
            'todo[complete]',
            $todo->getComplete()
        );
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::POST);
        if (201 != $response->getStatus()) {
            //TODO: throw more specific exception
            throw new Exception('Todo not created.');
        }
        $location = $response->getHeader('location');
        $httpClient = new Zend_Http_Client($location);
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::GET);
        $xmlResponse = simplexml_load_string($response->getBody());
        $this->_populateTodoFromXmlElement($xmlResponse, $todo);
        return $this;
    }

    /**
     * Put Todo
     *
     * @param Batchblue_Service_BatchBook_Todo $todo
     * @return Batchblue_Service_BatchBook_TodoService   Provides a fluent interface
     */
    public function putTodo(Batchblue_Service_BatchBook_Todo $todo)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/todos/' . $todo->getId() . '.xml'
        );
        $paramsPut = array(
            'todo[title]'    => $todo->getTitle(),
            'todo[description]'     => $todo->getDescription(),
            'todo[due_date]'         => $todo->getDueDate(),
            'todo[flagged]'       => $todo->getFlagged(),
            'todo[complete]'       => $todo->getComplete(),
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
            throw new Exception('Todo not updated.');
        }
        return $this;
    }

    /**
     * Delete Todo
     *
     * @param Batchblue_Service_BatchBook_Todo $todo
     * @return Batchblue_Service_BatchBook_TodoService   Provides a fluent interface
     */
    public function deleteTodo(Batchblue_Service_BatchBook_Todo $todo)
    {
        $httpClient = new Zend_Http_Client(
            'https://' . $this->_accountName . '.batchbook.com/service/todos/' . $todo->getId() . '.xml'
        );
        $httpClient->setAuth($this->_token, 'x');
        $response = $httpClient->request(Zend_Http_Client::DELETE);
        if (200 != $response->getStatus()) {
            //TODO: throw more specific exception
            throw new Exception('Todo not deleted.');
        }
        return $this;
    }
}
