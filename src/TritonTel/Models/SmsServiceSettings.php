<?php

namespace TritonTel\Models;

class SmsServiceSettings extends Settings {
    
    protected $host;
    
    function __construct($host) {
        $this->host = $host;
        parent::__construct($host);
    }
    
    protected function loadSettings() {
        return [
                Settings::FIELD_KEY_HOST => $this->getHost(),
                Settings::FIELD_KEY_REGISTER_ENDPOINT => $this->getRegisterEndpoint(),
                Settings::FIELD_KEY_SECRET_CODES_SEND_ENDPOINT => $this->getSendSecretCodeEndpoint(),
                Settings::FIELD_KEY_SECRET_CODES_VERIFY_ENDPOINT => $this->getVerifySecretCodeEndpoint(),
                Settings::FIELD_KEY_MESSAGES_SEND_ENDPOINT => $this->getSendMesagesEndpoint(),
                Settings::FIELD_KEY_LOGOUT_ENDPOINT => $this->getLogoutEndpoint(),
                Settings::FIELD_KEY_TOKEN => $this->getToken()
            ];
    }

    protected function saveSettings($settings) {
        return true;
    }

}
