<?php

namespace TritonTel\Services;

use Http\Discovery\MessageFactoryDiscovery;
use Http\Client\Common\Exception\ClientErrorException;
use Http\Message\Authentication\Bearer;

class HttpRequestService implements IHttpRequestService{
    
    /**
     * Performes http requst
     * @param HttpClient        $httpClient HttpClient used to send request
     * @param RequestInterface  $request Request to be send
     * @return string
     * @throws ClientErrorException
     */
    public function send($httpClient, $request) {
        throw new \Exception('Not impemented');
    }
    
    private function sendRequest($verb, $url, $data = [], $headers = []) {
        $content = null;
        try{
            $ch = curl_init();

            $defaultHeaders = ["Connection: Keep-Alive", "Content-Type: application/json", "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36"];
            $headers = array_merge($defaultHeaders, $headers);
            if($verb === 'POST'){
                curl_setopt($ch, CURLOPT_POST,true);
                if(empty($data)){
                    $headers = array_merge($headers, ['Content-Length: 0']);
                }else{
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
                }
            }
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
            curl_setopt($ch, CURLOPT_TIMEOUT, 1000); //timeout in seconds
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
            
            $content = curl_exec ($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close ($ch);
            
            if((!empty($httpCode)) && ($httpCode != 200)){
                throw new \Exception('FAILED to open page:' . $url);
            }
        }catch(\Exception $e){
            //add logging here
            throw $e;
        }
        return $content;
    }
    
    /**
     * Creates instance of httpClient with given auth
     * @param Authentication $authentication. Defaults to null
     * @return HttpClient
     */
    public function getHttpClient($authentication = null){
        throw new \Exception('Not impemented');
    }
    
    public function APIRequestPOST($url, $data = null, $token = null){
        $headers = [];
        if(!empty($token)){
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        
        return $this->sendRequest('POST', $url, $data, $headers);
    }
    
    public function APIRequestGET($url, $token = null){
        $headers = [];
        if(!empty($token)){
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        
        return $this->sendRequest('POST', $url, [], $headers);
    }
    
}
