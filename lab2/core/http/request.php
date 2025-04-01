<?php
//Immutable use: we don't want the request to be modified as it's passed around
//in the code.

namespace core\http;

//Immutable (NOT CONSTANT/NOT SINGLETON)
//Each instance of the immutable instance, have different values, and cannot be
//changed after being instantiated. 

//basically once a request is made, you can view it, but it can't be modified.

class Request
{

    private $method;
    private $url;
    private $headers;
    private $body;
    private $params;
    private $postFields;

    function __construct($method, $url, $headers, $body, $params, $postFields)
    {
        $this->method = $method;
        $this->url = $url;
        $this->headers = $headers;
        $this->body = $body;
        $this->params = $params;
        $this->postFields = $postFields;
    }

    //GETTERS (NO SETTERS, MEANS ONCE CREATED USING CONSTRUCTOR, CANNOT BE CHANGED)
    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getPostFields()
    {
        return $this->postFields;
    }
}
