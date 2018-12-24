<?php
namespace TritonTel\Services;

use Http\Client\HttpClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\ContentLengthPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Discovery\HttpClientDiscovery;


class HttpClientFactory
{
    /**
     * Build the HTTP client to talk with the API.
     *
     * @param Authentication     $authentication   Instance of Authentication class
     * @param Plugin[]   $plugins List of additional plugins to use
     * @param HttpClient $client  Base HTTP client
     *
     * @return HttpClient
     */
    public static function create($authentication = null, array $plugins = [], HttpClient $client = null)
    {
        if (!$client) {
            $client = HttpClientDiscovery::find();
        }
        $plugins[] = new ErrorPlugin();
        $plugins[] = new ContentLengthPlugin();
        $plugins[] = new HeaderDefaultsPlugin([
            'Connection' => 'Keep-Alive',
            'Content-Type' => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36'
        ]);
        if($authentication){
            $plugins[] = new AuthenticationPlugin($authentication);
        }
        return new PluginClient($client, $plugins);
    }
}