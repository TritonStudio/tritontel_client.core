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
        try {
            $response = $httpClient->sendRequest($request);
        } catch (ClientErrorException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                // TODO: handle errors and codes here!
            }
            throw $e;
        }
        if((!$response) || ($response->getStatusCode() != 200)){
            throw new Exception('error occurred while sending request');
        }
        
        $content = $response->getBody()->getContents();
        return $content;
    }
    
    /**
     * Creates instance of httpClient with given auth
     * @param Authentication $authentication. Defaults to null
     * @return HttpClient
     */
    public function getHttpClient($authentication = null){
        return HttpClientFactory::create($authentication);
    }
    
    public function APIRequestPOST($url, $data = null, $token = null){
        return $this->send(
                $this->getHttpClient((empty($token) ? (new Bearer($token)) : null)),
                MessageFactoryDiscovery::find()->createRequest('POST', $url, [], ($data == null ? null : json_encode($data)))
            );
    }
    
    public function APIRequestGET($url, $token = null){
        return $this->send(
                $this->getHttpClient((empty($token) ? (new Bearer($token)) : null)),
                MessageFactoryDiscovery::find()->createRequest('GET', $url)
            );
    }
    
}
