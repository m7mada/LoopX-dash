<?php

namespace App\Services\Connectors;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;
use Unipile\UnipileSDK;

class Unipile extends Connector
{
    /**
     * Displays the Unipile screen to choose the required connection account.
     *
     * This function renders the interface where users can select the appropriate
     * account for establishing a connection. It ensures that the necessary
     * account details are provided for further processing.
     */
    public function initUnipileChoseScreen(){
        // curl --request GET --url https://api11.unipile.com:14100/api/v1/accounts --header 'X-API-KEY:m5MTkqt7.qk/xoTPS1inpItzQ8/VHzaFTDAfHkFVFUYxGYv+JimI=' --header 'accept: application/json'


        $baseUri = 'https://api11.unipile.com:14100/api/v1/accounts';
        $token = 'm5MTkqt7.qk/xoTPS1inpItzQ8/VHzaFTDAfHkFVFUYxGYv+JimI=';
        $unipileSDK = new UnipileSDK($baseUri, $token);
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    
        // dd(url('connectorCallback'));
        $linkAccount = $unipileSDK->Account->createHostedLink(
            'PT1H',
            'My User ID',
            url('successConnection'),
            $actual_link.'?status=fail',
            url('connectorCallback'),
            '',
            '*'
        );

        return  $linkAccount['url'];

        // $linkedAccounts = $unipileSDK->Account->list();
        // $this->linkedAccounts = $linkedAccounts;
        // dd($this->linkedAccounts['items']);

        // dd($accounts);
    }
}