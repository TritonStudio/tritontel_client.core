<?php

namespace App\Models;

interface ISettings {
    
    public function get(string $key = NULL);
    
    public function set(Array $settings);
    
    public function save();
}
