<?php

namespace TritonTel\Services;
use Http\Discovery\MessageFactoryDiscovery;

class HttpRequestFactory
{
    /**
     * Build the HTTP request instance.
     *
     * @param string    $method     Request type
     * @param string    $url        Url
     * @param array     $headers    Headers to be sent. Defaults [],
     * @param mixed     $body       Request body. Defaults = null,
     *
     * @return RequestInterface
     */
    public static function create($method, $url, $headers=[], $body = null){
        return MessageFactoryDiscovery::find()->createRequest($method, $url, $headers, $body);
    }
}

