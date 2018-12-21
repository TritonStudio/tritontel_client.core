<?php

namespace TritonTel\Services;

interface IHttpRequestService {
    
    public function send($verb, $url, $data = [], $headers = []);
}
