<?php
namespace ChipChapLL\Core;


class ApiRequest implements Request{

    private $baseUrl;
    private $function;
    private $urlParams;
    private $method;
    private $params;
    private $headers;

    public function __construct($baseUrl,$function,$urlParams,$method,$params,$headers){
        $this->baseUrl = $baseUrl;
        $this->function = $function;
        $this->urlParams = $urlParams;
        $this->method = $method;
        $this->params = $params;
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @return mixed
     */
    public function getUrlParams()
    {
        return $this->urlParams;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

}