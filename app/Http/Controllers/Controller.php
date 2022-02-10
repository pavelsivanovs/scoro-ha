<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var string[]
     */
    protected $default_body;

    /**
     * @var string[]
     */
    protected $headers;

    /**
     * @var Client
     */
    protected $scoro;

    public function __construct()
    {
        $this->default_body = [
            'apiKey' => env('SCORO_API_KEY'),
            'company_account_id' => env('SCORO_COMPANY_ACCOUNT_ID'),
            'lang' => 'eng'
        ];

        $this->headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/json'
        ];

        $this->scoro = new Client([
            'base_uri' => env('SCORO_SITE_URL') . '/api/v2/'
        ]);
    }
}
