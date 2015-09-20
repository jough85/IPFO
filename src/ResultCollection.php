<?php

namespace SNicholson\IPFO;

class ResultCollection
{
    /**
     * @var
     */
    private $responses;
    private $success;
    private $dataSource;

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param mixed $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @param Result $response
     *
     */
    public function addResponse(Result $response)
    {
        $this->responses[] = $response;
    }

    public function getResponses()
    {
        return $this->responses;
    }

    public function getResult()
    {
        return $this->responses[0];
    }
}