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
        echo "****CONTENT:" . $content . "****";
        return $content;
    }
    
    /**
     * sends request of type GET
     * @param string $url
     * @return string
     */
    private function sendGET($url){
        $content = $this->httpRequestService->APIRequestGET($url,$this->smsServiceSettings->getToken());
        echo "****CONTENT:" . $content . "****";
        return $content;
    }
    
    public function register($email, $phone, $password, $company, $serviceName) {
        echo "|SmsServiceClient register implementation|";
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
    }

    
    public function secretCodesSend($phone, $templateId = null, $messagePattern = null){
        echo "|SmsServiceClient secretCodesSend implementation|";
        $data = [
            'phone' => $phone,
            'templateId' => $templateId,
            'messagePattern' => $messagePattern
        ];
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendSecretCodeEndpoint()),
                $data
                );
    }
    
    public function secretCodesVerify($phone, $code){
        echo "|SmsServiceClient secretCodesVerify implementation|";
        $data = [
            'phone' => $phone,
            'code' => $code
        ];
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getVerifySecretCodeEndpoint()),
                $data
                );
    }
    
    public function messagesSend($recipient, $message){
        echo "|SmsServiceClient messagesSend implementation|";
        $data = [
            'recipient' => $recipient,
            'message' => $message
        ];
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendMesagesEndpoint()),
                $data
                );
    }
    
    public function valuesGetCompanyData(){
        echo "|SmsServiceClient GetCompanyData implementation|";
        $content = $this->sendGET(
                $this->getEndpointFullUrl($this->smsServiceSettings->getGetCompanyDataEndpoint())
                );
    }
    
    public function logout(){
        echo "|SmsServiceClient logout implementation|";
        $content = $this->sendPOST(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendMesagesEndpoint())
                );
        echo "****done****";
    }

}
