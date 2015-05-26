<?php
namespace ChipChapLL;


use ChipChapLL\Core\ApiRequest;
use ChipChapLL\Core\Credentials;
use ChipChapLL\Core\JsonRequester;
use ChipChapLL\Core\SignerV1;

class BaseRequester {

    private $credentials;
    private $url;

    public function __construct(Credentials $credentials, $url){
        $this->credentials = $credentials;
        $this->url = $url;
    }

    protected function call($function,$urlParams,$method,$params,$headers){
        $plainRequest = new ApiRequest(
            $this->url,
            $function,
            $urlParams,
            $method,
            $params,
            $headers
        );
        $signer = new SignerV1($this->credentials);
        $signedRequest = $signer->sign($plainRequest);
        $requester = new JsonRequester();
        return $requester->send($signedRequest);
    }

}
