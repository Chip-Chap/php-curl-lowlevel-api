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
        $signatureHeader = $this->getV1SignatureHeader(
            $this->credentials->getPublicId(),
            base64_decode($this->credentials->getSecret())
        );

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

    private function getV1SignatureHeader($access_key, $access_secret){
        $nonce = rand();
        $timestamp = time();
        $version = "1";
        $stringToEncrypt = $access_key.$nonce.$timestamp;
        $signature = hash_hmac('SHA256', $stringToEncrypt, $access_secret);
        return 'Signature '
        ."access-key=\"$access_key\", "
        ."nonce=\"$nonce\", "
        ."timestamp=\"$timestamp\", "
        ."version=\"$version\", "
        ."signature=\"$signature\"";

    }
}
