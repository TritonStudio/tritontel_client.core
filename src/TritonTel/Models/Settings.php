<?php
namespace App\Models;

abstract class Settings implements ISettings {
    
    const FIELD_KEY_HOST = 'host';
    const FIELD_KEY_REGISTER_ENDPOINT = 'register';
    const FIELD_KEY_SECRET_CODES_SEND_ENDPOINT = 'sendSecretCodes';
    const FIELD_KEY_SECRET_CODES_VERIFY_ENDPOINT = 'verifySecretCodes';
    const FIELD_KEY_MESSAGES_SEND_ENDPOINT = 'sendMessages';
    const FIELD_KEY_GET_COMPANY_DATA_ENDPOINT = 'getCompanyData';
    const FIELD_KEY_LOGOUT_ENDPOINT = 'logout';
    const FIELD_KEY_TOKEN = 'token';
    
    
    protected $settings;
    
    public function getHost(){
        return $this->get(self::FIELD_KEY_HOST);
    }
    
    public function setHost(string $host){
        $this->settings[self::FIELD_KEY_HOST] = $host;
    }
    
    public function getRegisterEndpoint(){
        return $this->get(self::FIELD_KEY_REGISTER_ENDPOINT);
    }
    
    public function setRegisterEndpoint(string $registerEndpoint){
        $this->settings[self::FIELD_KEY_REGISTER_ENDPOINT] = $registerEndpoint;
    }
    
    public function getSendSecretCodeEndpoint(){
        return $this->get(self::FIELD_KEY_SECRET_CODES_SEND_ENDPOINT);
    }
    
    public function setSendSecretCodeEndpoint(string $sendSecretCodeEndpoint){
        $this->settings[self::FIELD_KEY_SECRET_CODES_SEND_ENDPOINT] = $sendSecretCodeEndpoint;
    }
    
    public function getVerifySecretCodeEndpoint(){
        return $this->get(self::FIELD_KEY_SECRET_CODES_VERIFY_ENDPOINT);
    }
    
    public function setVerifySecretCodeEndpoint(string $verifySecretCodeEndpoint){
        $this->settings[self::FIELD_KEY_SECRET_CODES_VERIFY_ENDPOINT] = $verifySecretCodeEndpoint;
    }
    
    public function getSendMesagesEndpoint(){
        return $this->get(self::FIELD_KEY_MESSAGES_SEND_ENDPOINT);
    }
    
    public function setSendMessagesEndpoint(string $sendMessagesEndpoint){
        $this->settings[self::FIELD_KEY_MESSAGES_SEND_ENDPOINT] = $sendMessagesEndpoint;
    }
    
    public function getGetCompanyDataEndpoint(){
        return $this->get(self::FIELD_KEY_GET_COMPANY_DATA_ENDPOINT);
    }
    
    public function setGetCompanyDataEndpoint(string $getCompanyDataEndpoint){
        $this->settings[self::FIELD_KEY_GET_COMPANY_DATA_ENDPOINT] = $getCompanyDataEndpoint;
    }
    
    public function getLogoutEndpoint(){
        return $this->get(self::FIELD_KEY_LOGOUT_ENDPOINT);
    }
    
    public function setLogoutEndpoint(string $logoutEndpoint){
        $this->settings[self::FIELD_KEY_LOGOUT_ENDPOINT] = $logoutEndpoint;
    }
    
    public function getToken(){
        return $this->get(self::FIELD_KEY_TOKEN);
    }
    
    public function setToken(string $token){
        $this->settings[self::FIELD_KEY_TOKEN] = $token;
    }
    
    public function get(string $key = NULL){
        if(empty($this->settings)){
            $this->settings = $this->loadSettings();
        }
        if($key !== NULL){
            if(isset($this->settings[$key])){
                return $this->settings[$key];
            }
            return null;
        }
        return $this->settings;
    }
    
    public function set(Array $settings){
        $this->settings = $settings;
        return $this->saveSettings($settings);
    }
    
    public function save(){
        return $this->saveSettings($this->settings);
    }
    
    abstract protected function loadSettings();
    
    abstract protected function saveSettings(Array $settings);
}