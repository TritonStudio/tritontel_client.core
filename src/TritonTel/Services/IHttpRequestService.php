<?php

namespace TritonTel\Services;

interface IHttpRequestService {
    
    public function send($httpClient, $request);
}
