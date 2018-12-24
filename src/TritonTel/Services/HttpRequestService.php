<?php

namespace TritonTel\Services;

use Http\Client\Common\Exception\ClientErrorException;

class HttpRequestService implements IHttpRequestService{
    
    /**
     * Performes http requst
     * @param HttpClient        $httpClient HttpClient used to send request
     * @param RequestInterface  $request Request to be send
     * @return string
     * @throws ClientErrorException
     */
    public function send($httpClient, $request) {
        $content = null;

        try {
            $content = $httpClient->sendRequest($request);
        } catch (ClientErrorException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                // TODO: handle errors and codes here!
            }
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
        return HttpClientFactory::create($authentication);
    }
}
