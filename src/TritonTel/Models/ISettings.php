<?php

namespace TritonTel\Models;

interface ISettings {
    
    public function get($key = NULL);
    
    public function set($settings);
    
    public function save();
}
