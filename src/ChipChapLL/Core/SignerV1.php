<?php
namespace ChipChapLL\Core;


class SignerV1 implements Signer{

    private $credentials;

    public function __construct(Credentials $credentials){
        $this->credentials=$credentials;
    }

    public function sign(Request $request)
    {
        $currentHeaders = $request->getHeaders();
        $signatureHeader = $this->getV1SignatureHeader();

        $currentHeaders['x-signature']=$signatureHeader;

        return new ApiRequest(
            $request->getBaseUrl(),
            $request->getFunction(),
            $request->getUrlParams(),
            $request->getMethod(),
            $request->getParams(),
            $currentHeaders
        );
    }

    public function getV1SignatureHeader(){
        $nonce = rand();
        $timestamp = time();
        $version = "1";
        $stringToEncrypt = $this->credentials->getPublicId().$nonce.$timestamp;
        $signature = $this->signRaw($stringToEncrypt);
        return 'Signature '
        ."access-key=\"" . $this->credentials->getPublicId() . "\", "
        ."nonce=\"$nonce\", "
        ."timestamp=\"$timestamp\", "
        ."version=\"$version\", "
        ."signature=\"$signature\"";

    }

    public function signRaw($data){
        return hash_hmac('SHA256', $data, base64_decode($this->credentials->getSecret()));
    }
}
