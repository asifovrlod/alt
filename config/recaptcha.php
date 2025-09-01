<?php

return [
    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure your reCAPTCHA settings. You need to get your
    | site key and secret key from https://www.google.com/recaptcha/admin
    |
    */

    'site_key' => env('RECAPTCHA_SITE_KEY', ''),
    'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),
    
    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Version
    |--------------------------------------------------------------------------
    |
    | Choose between 'v2' (checkbox) or 'v3' (invisible)
    |
    */
    
    'version' => env('RECAPTCHA_VERSION', 'v2'),
    
    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Language
    |--------------------------------------------------------------------------
    |
    | Set the language for reCAPTCHA (optional)
    |
    */
    
    'language' => env('RECAPTCHA_LANGUAGE', 'en'),
]; 