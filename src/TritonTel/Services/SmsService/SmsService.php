<?php

namespace TritonTel\Services\SmsService;

use Http\Message\Authentication\Bearer;
use Http\Discovery\MessageFactoryDiscovery;

class SmsService implements ISmsService{
    
    private $httpRequestService;
    private $smsServiceSettings;
    
    function __construct($httpRequestService, $smsServiceSettings) {
        echo "|SmsService constructor|";
        $this->httpRequestService = $httpRequestService;
        $this->smsServiceSettings = $smsServiceSettings;
    }
    
    public function check(){
        echo "|SmsService check|";
    }
    
    private function getEndpointFullUrl($endpointUrl){
        return $this->smsServiceSettings->getHost() . $endpointUrl;
    }
    
    /**
     * Defines Authentication type for API
     * @return Bearer
     */
    private function getAPIAuth(){
        return new Bearer($this->smsServiceSettings->getToken());
    }
    
    /**
     * sends request of type POST
     * @param string $url
     * @param array $data
     * @param bool $auth
     * @return string
     */
    private function sendPostRequest($url,$data, $auth=true){
        $httpClient = null;
        if($auth){
            $httpClient = $this->httpRequestService->getHttpClient($this->getAPIAuth());
        }else{
            $httpClient = $this->httpRequestService->getHttpClient();
        }
        $request = MessageFactoryDiscovery::find()->createRequest('POST', $url, [], ($data == null ? null : json_encode($data)));
        $response = $this->httpRequestService->send($httpClient,$request);
        if($response->getStatusCode() != 200){
            throw new Exception('error occurred');
        }
        
        $content = $response->getBody()->getContents();
        echo "****CONTENT:" . $content . "****";
        return $content;
    }
    
    /**
     * sends request of type GET
     * @param string $url
     * @param bool $auth
     * @return string
     */
    private function sendGetRequest($url, $auth=true){
        $httpClient = null;
        if($auth){
            $httpClient = $this->httpRequestService->getHttpClient($this->getAPIAuth());
        }else{
            $httpClient = $this->httpRequestService->getHttpClient();
        }
        $request = MessageFactoryDiscovery::find()->createRequest('GET', $url);
        if($response->getStatusCode() != 200){
            throw new Exception('error occurred');
        }
        
        $content = $this->httpRequestService->send($httpClient,$request);
        echo "****CONTENT:" . $content . "****";
        return $content;
    }

    public function authenticate() {
        
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
        $content = $this->sendPostRequest(
                $this->getEndpointFullUrl($this->smsServiceSettings->getRegisterEndpoint()),
                $data,
                false);
        
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
        $content = $this->sendPostRequest(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendSecretCodeEndpoint()),
                $data);
    }
    
    public function secretCodesVerify($phone, $code){
        echo "|SmsServiceClient secretCodesVerify implementation|";
        $data = [
            'phone' => $phone,
            'code' => $code
        ];
        $content = $this->sendPostRequest(
                $this->getEndpointFullUrl($this->smsServiceSettings->getVerifySecretCodeEndpoint()),
                $data);
    }
    
    public function messagesSend($recipient, $message){
        echo "|SmsServiceClient messagesSend implementation|";
        $data = [
            'recipient' => $recipient,
            'message' => $message
        ];
        $content = $this->sendPostRequest(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendMesagesEndpoint()),
                $data);
    }
    
    public function valuesGetCompanyData(){
        echo "|SmsServiceClient GetCompanyData implementation|";
        $content = $this->sendGetRequest($this->getEndpointFullUrl($this->smsServiceSettings->getGetCompanyDataEndpoint()));
    }
    
    public function logout(){
        echo "|SmsServiceClient logout implementation|";
        $content = $this->sendPostRequest(
                $this->getEndpointFullUrl($this->smsServiceSettings->getSendMesagesEndpoint()),
                []);
        echo "****done****";
    }

}
