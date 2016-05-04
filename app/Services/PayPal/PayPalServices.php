<?php namespace App\Services\PayPal;


class PayPalServices
{
    protected $services;
    public function __construct()
    {
        $this->services = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AbO23qMEdF7Cr_2Og6gwLsSjiTb3wOjlJyBRPOYA9L9R6Bfjf0dG_SFPb2Idn_-PDuoeS2oCIGGrryi0',
                'EMldIYgsxS8GqWx3T0mbNIukxXh7P8i0YJc6cZDkoI-VyXjsYneLT6yI1sOnLIaVucd3YvCsKaSXpQuS'
            )
        );
    }
}