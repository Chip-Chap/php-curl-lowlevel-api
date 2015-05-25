<?php
namespace ChipChapLL\Core;

class UserCredentials implements Credentials{
    private $publicId;
    private $secret;

    public function __construct($publicId, $secret){
        $this->publicId=$publicId;
        $this->secret=$secret;
    }
    /**
     * @return mixed
     */
    public function getPublicId()
    {
        return $this->publicId;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }
}