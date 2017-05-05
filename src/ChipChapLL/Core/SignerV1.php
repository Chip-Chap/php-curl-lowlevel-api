<?php
namespace ChipChapLL\Core;


class SignerV1 implements Signer{

    /** @var Credentials $credentials */
    protected $credentials;

    public function __construct(Credentials $credentials){
        $this->credentials=$credentials;
    }

    /**
     * @param Request $request
     * @return ApiRequest
     */
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

    /**
     * @return string
     */
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

    /**
     * @param $data
     * @return string
     */
    public function signRaw($data){
        return hash_hmac('SHA256', $data, base64_decode($this->credentials->getSecret()));
    }
}
