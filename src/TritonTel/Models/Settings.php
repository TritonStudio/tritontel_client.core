<?php
namespace TritonTel\Models;

abstract class Settings implements ISettings {
    
    const FIELD_KEY_HOST = 'host';
    const FIELD_KEY_REGISTER_ENDPOINT = 'register';
    const FIELD_KEY_SECRET_CODES_SEND_ENDPOINT = 'sendSecretCodes';
    const FIELD_KEY_SECRET_CODES_VERIFY_ENDPOINT = 'verifySecretCodes';
    const FIELD_KEY_MESSAGES_SEND_ENDPOINT = 'sendMessages';
    const FIELD_KEY_GET_COMPANY_DATA_ENDPOINT = 'getCompanyData';
    const FIELD_KEY_LOGOUT_ENDPOINT = 'logout';
    const FIELD_KEY_TOKEN = 'token';
    
    
    protected $settings = [];
    
    public function __construct($host) {
        $this->settings = $this->loadSettings();
        $this->setHost($host);
    }


    public function getHost(){
        return $this->get(self::FIELD_KEY_HOST);
    }
    
    public function setHost($host){
        $this->settings[self::FIELD_KEY_HOST] = $host;
    }
    
    public function getRegisterEndpoint(){
        return '/api/Account/Register';
    }
    
    public function getSendSecretCodeEndpoint(){
        return '/api/SecretCodes/Send';
    }
    
    public function getVerifySecretCodeEndpoint(){
        return '/api/SecretCodes/Verify';
    }
    
    public function getSendMesagesEndpoint(){
        return '/api/Messages/Send';
    }
    
    public function getGetCompanyDataEndpoint(){
        return '';
    }
    
    public function getLogoutEndpoint(){
        return '/api/Account/Logout';
    }
    
    public function getToken(){
        return $this->get(self::FIELD_KEY_TOKEN);
    }
    
    public function setToken($token){
        $this->settings[self::FIELD_KEY_TOKEN] = $token;
    }
    
    public function get($key = NULL){
        if(!empty($key)){
            if(isset($this->settings[$key])){
                return $this->settings[$key];
            }
            return null;
        }
        return $this->settings;
    }
    
    public function set($settings){
        $this->settings = $settings;
        return $this->saveSettings($settings);
    }
    
    public function save(){
        return $this->saveSettings($this->settings);
    }
    
    abstract protected function loadSettings();
    
    abstract protected function saveSettings($settings);
}
