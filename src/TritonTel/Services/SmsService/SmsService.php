<?php

namespace TritonTel\Services\SmsService;

class SmsService implements ISmsService{
    
    private $httpRequestService;
    public $smsServiceSettings;
    
    function __construct($httpRequestService, $smsServiceSettings) {
        $this->httpRequestService = $httpRequestService;
        $this->smsServiceSettings = $smsServiceSettings;
    }
    
    private function getEndpointFullUrl($endpointUrl){
        return $this->smsServiceSettings->getHost() . $endpointUrl;
    }

    /**
     * sends request of type POST
     * @param string $url
     * @param array $data
     * @return string
     */
    private function sendPOST($url,$data){
        $content = $this->httpRequestService->APIRequestPOST($url,$data,$this->smsServiceSettings->getToken());
        return json_encode($content);
    }
    
    /**
     * sends request of type GET
     * @param string $url
     * @return string
     */
    private function sendGET($url){
        $content = $this->httpRequestService->APIRequestGET($url,$this->smsServiceSettings->getToken());
        return json_encode($content);
    }
    
    public function register($email, $phone, $password, $company, $serviceName) {
        $data = [
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'companyName' => $company,
            'serviceName' => $serviceName
        ];
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getRegisterEndpoint()),
                $data
                );
        
        $content_obj = json_decode($content);
        if($content_obj){
            $this->smsServiceSettings->setToken($content_obj->access_token);
            $this->smsServiceSettings->save();//TODO: Remove later?
        }
        return $content_obj;
    }

    
    public function secretCodesSend($phone, $templateId = null, $messagePattern = null){
        $data = [
            'phone' => $phone,
            'templateId' => $templateId,
            'messagePattern' => $messagePattern
        ];
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendSecretCodeEndpoint()),
                $data
                );
        return json_decode($content);
    }
    
    public function secretCodesVerify($phone, $code){
        $data = [
            'phone' => $phone,
            'code' => $code
        ];
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getVerifySecretCodeEndpoint()),
                $data
                );
        return json_decode($content);
    }
    
    public function messagesSend($recipient, $message){
        $data = [
            'recipient' => $recipient,
            'message' => $message
        ];
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendMesagesEndpoint()),
                $data
                );
        return json_decode($content);
    }
    
    public function valuesGetCompanyData(){
        $content = $this->sendGET(
                $this->getEndpointFullUrl($this->smsServiceSettings->getGetCompanyDataEndpoint())
                );
        return json_decode($content);
    }
    
    public function logout(){
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendMesagesEndpoint())
                );
        return json_decode($content);
    }

}
