<?php

namespace App\Models;

use App\Models\Settings;

class SmsServiceSettings extends Settings {
    
    protected $host;
    
    function __construct(string $host) {
        $this->host = $host;
    }
    
    protected function loadSettings() {
        echo '|loading settings|';
        return [
                Settings::FIELD_KEY_HOST => $this->host,
                Settings::FIELD_KEY_REGISTER_ENDPOINT => '/api/Account/Register',
                Settings::FIELD_KEY_SECRET_CODES_SEND_ENDPOINT => '/api/SecretCodes/Send',
                Settings::FIELD_KEY_SECRET_CODES_VERIFY_ENDPOINT => '/api/SecretCodes/Verify',
                Settings::FIELD_KEY_MESSAGES_SEND_ENDPOINT => '/api/Messages/Send',
                Settings::FIELD_KEY_LOGOUT_ENDPOINT => '/api/Account/Logout',
                Settings::FIELD_KEY_TOKEN => 'DSddS21QEC6AlBNpc7aei8PioDCrBg9o0BdRegDwcZnXIk2Q8U9nub_ZB4VU1w-zhs2ryVyr1mnZgsuhA3F_ttM8opusTtXIaFUjnp-mE1uqnrH_7KwYuY8z1fA2qZ-gNlyKwoymxcGfUhxC73mRHHcBfIV___LzMzcsqZPzUA1As3e5ia9xa0BXEvA0MVXnxzNxBqP4s4W1fuRtZ6Xd0mhJyoDj64ilpxr7yT9GnjQZmcuFK9RS-YORPMnBlYoq9Zgc_1PM0XwzVF0gMeU0XRdbIUVeQPZBaaT3oUAaWPhnQG2TrOSizH_qEY7jRdZD2nnTF0879y98wWa8IC4SBh2SS2Syx7qLgxzTMD5fB8iex_HKIRjsDOF69CUgnp3IBfuhHa0hEhRsaVCFfu1vvWvMO2NONqanQRP5RBnQw65tN6BtJM0RPWS_E6s9nbJ5CCf4uJk3QyYjQpGbMok4DbRgK3EKib3xfrtNWaEg2LqqV9oOQ49RUU5HBfE7jd6w6q_3bw',
//'acpIvSbbi-bYf_GwjjsoTnAZxD4i2d-DwUl22wLk0nZ4Kt2dybYXrbfLQW5LmfhMzWdkPYTxThk32POenF9sb5lQGxna_ozZ2tCHpoe3DV7gYgPSKupY5eddv6oxMp9goJ49fDXl16HP8DO742K8-myBCNwFZoT0SPdfSHsK0b-dFs1sqgAGiqfrtIjgncoFIjbgqtwesrZ4kKKSljAvftOtPr0kgUnszXG1dvL-kfSjlp7o1UvH4bZHzMdKHfC4MRcK89zsRpxLJLJZJphHb-cYIU0jb4PrTBK-CwJbkqAI3knCfgkfPf7dRL24eV5wldIST-UXsTPRyZYOZhSVnfM46_p_o5do9w2nM8X0ESbF9_GrRxydMHRico3W9GLAeRjD88f67DSRWOs5HIYQC6GF-q352e1C_JupwmH_ofGTix4Ew-qaPucRTycGlB-j-W3sUKGFakgBqT6rPs4XyQ4DkOw_hmo0B7m6amEG3HDhzzAZEkUBv_f6JW3fdzmc',
            ];
    }

    protected function saveSettings(array $settings) {
        echo '|saving settings|';
        var_dump($settings);
        return true;
    }

}
