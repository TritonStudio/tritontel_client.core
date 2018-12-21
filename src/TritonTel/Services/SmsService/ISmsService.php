<?php

namespace TritonTel\Services\SmsService;

interface ISmsService {
    
    public function authenticate();
    
    public function register($email, $phone, $password, $company, $serviceName);
    
    public function secretCodesSend($phone, $templateId = null, $messagePattern = null);
    
    public function secretCodesVerify($phone, $code);
    
    public function messagesSend($recipient, $message);
    
    public function valuesGetCompanyData();
    
    public function logout();
}
