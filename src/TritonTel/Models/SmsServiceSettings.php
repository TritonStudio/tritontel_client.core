<?php

namespace TritonTel\Models;

class SmsServiceSettings extends Settings {
    
    protected $host;
    
    function __construct($host) {
        $this->host = $host;
    }
    
    protected function loadSettings() {
        return [
                Settings::FIELD_KEY_HOST => $this->host,
                Settings::FIELD_KEY_REGISTER_ENDPOINT => '/api/Account/Register',
                Settings::FIELD_KEY_SECRET_CODES_SEND_ENDPOINT => '/api/SecretCodes/Send',
                Settings::FIELD_KEY_SECRET_CODES_VERIFY_ENDPOINT => '/api/SecretCodes/Verify',
                Settings::FIELD_KEY_MESSAGES_SEND_ENDPOINT => '/api/Messages/Send',
                Settings::FIELD_KEY_LOGOUT_ENDPOINT => '/api/Account/Logout',
                Settings::FIELD_KEY_TOKEN => 'kbl8Pvr9tmEtdymFybplkUDaHbl1cH4esKcqAtM8MwWTAgPvO5OwPjtMTVJ0LOtbP5nMZPANcaUpnS_TRNBDrCQdtNkDyMRjubsQ5a54GhwsuNpE51c2rGDjLJhGIu2TBPTD_aRrd4NfGR5FEIFX6tBMyHO4Zb0C-_fphd0PO7u8C7bvXwOBYnCGcNFdmVQZOFkXrDQSHy6Wdj2aRnbDxIyMXvr3k2Ae7swybehxpmpKDlIC4cWSX1A-b-esZ3swUf441Buq5QeEFZApUQ2FhVbE2zcA-raeD1EM2rYdut0uxlYL1kMqEqbA-jgKsgq6jZZm32ixmZ_sOmLUjLGnVsU7aj0_Qah2WXxhkCM1psMWtiWfCHlFpNqoNkEJKzADmN1UDO6PiwaX5QnVR_bBy3ubMJiy8yF4GEjDiKnCY2UH4kipXVEeR8aG9Z0FMu3Gh4_dHxiZC5s2ITBf-GMZx_z0Erblbhjs-IeRqzWj2KWyXzC0h1EZi6PVEFa8G_7kKCxX6w',
//'acpIvSbbi-bYf_GwjjsoTnAZxD4i2d-DwUl22wLk0nZ4Kt2dybYXrbfLQW5LmfhMzWdkPYTxThk32POenF9sb5lQGxna_ozZ2tCHpoe3DV7gYgPSKupY5eddv6oxMp9goJ49fDXl16HP8DO742K8-myBCNwFZoT0SPdfSHsK0b-dFs1sqgAGiqfrtIjgncoFIjbgqtwesrZ4kKKSljAvftOtPr0kgUnszXG1dvL-kfSjlp7o1UvH4bZHzMdKHfC4MRcK89zsRpxLJLJZJphHb-cYIU0jb4PrTBK-CwJbkqAI3knCfgkfPf7dRL24eV5wldIST-UXsTPRyZYOZhSVnfM46_p_o5do9w2nM8X0ESbF9_GrRxydMHRico3W9GLAeRjD88f67DSRWOs5HIYQC6GF-q352e1C_JupwmH_ofGTix4Ew-qaPucRTycGlB-j-W3sUKGFakgBqT6rPs4XyQ4DkOw_hmo0B7m6amEG3HDhzzAZEkUBv_f6JW3fdzmc',
            ];
    }

    protected function saveSettings($settings) {
        return true;
    }

}
