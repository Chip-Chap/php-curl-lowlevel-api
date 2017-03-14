<?php
namespace ChipChapLL;


use ChipChapLL\Core\ApiRequest;
use ChipChapLL\Core\Credentials;
use ChipChapLL\Core\JsonRequester;
use ChipChapLL\Core\SignerV1;

abstract class BaseRequester {

    /**
     * @return string
     */
    abstract public function getUrl();

    /**
     * @return Credentials
     */
    abstract public function getCredentials();

    /**
     * @param $function
     * @param $urlParams
     * @param $method
     * @param $params
     * @param $headers
     * @return mixed
     */
    protected function call($function,$urlParams,$method,$params,$headers){
        $plainRequest = new ApiRequest(
            $this->getUrl(),
            $function,
            $urlParams,
            $method,
            $params,
            $headers
        );
        $signer = new SignerV1($this->getCredentials());
        $signedRequest = $signer->sign($plainRequest);
        $requester = new JsonRequester();
        return $requester->send($signedRequest);
    }

}
