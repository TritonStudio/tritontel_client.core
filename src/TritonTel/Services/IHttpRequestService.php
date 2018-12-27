<?php

namespace TritonTel\Services;

interface IHttpRequestService {
    
    public function send($httpClient, $request);
    
    public function getHttpClient($authentication = null);
    
    public function APIRequestPOST($url, $data = null, $token = null);
    
    public function APIRequestGET($url, $token = null);
}
