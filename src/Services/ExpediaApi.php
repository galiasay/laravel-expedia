<?php

namespace Galiasay\Expedia\Services;

use GuzzleHttp\Client;

/**
 * Class ExpediaApi
 * @package Galiasay\Expedia\Services
 */
class ExpediaApi
{
    /**
     * Access key to the API.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Account ID.
     *
     * @var string
     */
    protected $cid;

    /**
     * Shared secret.
     *
     * @var string
     */
    protected $secretKey;

    /**
     * The minor revision used for processing requests and returning responses.
     *
     * @var int
     */
    protected $minorRev = 30;

    /**
     * Returns data in other languages where available for Expedia Collect properties only.
     *
     * @var string
     */
    protected $locale = 'en_US';

    /**
     * Returns data in other currencies where available.
     *
     * @var string
     */
    protected $currencyCode = 'USD';

    /**
     * Identify the origin of the request.
     *
     * @var string
     */
    protected $apiExperience = 'PARTNER_WEBSITE';

    /**
     * Insert your own unique value for each customer beginning with their first hotel list search,
     * or use the value returned in the initial list response for the remainder of the booking path.
     * Continue to pass this same value for each customer during each booking session,
     * using a new value for every new customer session.
     * Including this value greatly eases EAN's internal debugging process for issues with partner requests,
     * as it explicitly links together request paths for individual customers.
     *
     * @var string
     */
    protected $customerSessionId;

    /**
     * IP address of the customer, as captured by your integration.
     * Ensure your integration passes the customer's IP, not your own.
     * This value helps determine their location and assign the correct payment gateway.
     *
     * @var string
     */
    protected $customerIpAddress;

    /**
     * The user-agent header string from the request.
     *
     * @var string
     */
    protected $customerUserAgent;

    /**
     * The sig value used with signature authentication.
     * All sig values are required to be at least 32 lower-case characters in length.
     * If you receive errors when generating your own digital signature,
     * send a ping request to verify your Unix time against EAN's or check your value against EAN's sig generator.
     *
     * @var string
     */
    protected $sig;

    /**
     * Available methods for requests.
     *
     * @var array
     */
    protected $availableMethods = [
        [
            'method' => 'get',
            'url' => 'http://api.eancdn.com/ean-services/rs/hotel/v3'
        ],
        [
            'method' => 'post',
            'url' => 'https://book.api.ean.com/ean-services/rs/hotel/v3'
        ]
    ];

    /**
     * @param $method
     * @param $params
     * @return \Psr\Http\Message\StreamInterface
     */
    public function __call($method, $params)
    {
        if (!($url = $this->getUrlByMethod($method))) {
            throw new \BadMethodCallException("Unsupported method call `{$method}`.");
        }

        $path = $params[0];
        $args = array_merge($this->getRequestParams(), array_slice($params, 1));

        $client = new Client();
        $response = $client->request($method, $url . '/' . $path, [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'query' => $args
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @return array
     */
    protected function getRequestParams()
    {
        if (!$this->sig) {
            $this->sig = $this->generateSig();
        }

        return [
            'cid'               => $this->cid,
            'apiKey'            => $this->apiKey,
            'minorRev'          => $this->minorRev,
            'locale'            => $this->locale,
            'sig'               => $this->sig,
            'currencyCode'      => $this->currencyCode,
            'customerSessionId' => $this->customerSessionId,
            'customerIpAddress' => $this->customerIpAddress,
            'customerIpAddress' => $this->customerIpAddress
        ];
    }

    /**
     * @return null|string
     */
    protected function generateSig()
    {
        return $this->secretKey ? md5($this->apiKey . $this->secretKey . gmdate('U')) : null;
    }

    /**
     * @param $method
     * @return bool
     */
//    protected function checkAvailableMethod($method)
//    {
//        return in_array($method, array_column($this->availableMethods, 'method'));
//    }

    /**
     * @param $method
     * @return mixed
     */
    protected function getUrlByMethod($method)
    {
        return array_reduce($this->availableMethods, function ($carry, $item) use ($method) {
            return $item['method'] == $method ? $item['url'] : $carry;
        });
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @param string $cid
     */
    public function setCid($cid)
    {
        $this->cid = $cid;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return int
     */
    public function getMinorRev()
    {
        return $this->minorRev;
    }

    /**
     * @param int $minorRev
     */
    public function setMinorRev($minorRev)
    {
        $this->minorRev = $minorRev;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return string
     */
    public function getApiExperience()
    {
        return $this->apiExperience;
    }

    /**
     * @param string $apiExperience
     */
    public function setApiExperience($apiExperience)
    {
        $this->apiExperience = $apiExperience;
    }

    /**
     * @return string
     */
    public function getCustomerSessionId()
    {
        return $this->customerSessionId;
    }

    /**
     * @param string $customerSessionId
     */
    public function setCustomerSessionId($customerSessionId)
    {
        $this->customerSessionId = $customerSessionId;
    }

    /**
     * @return string
     */
    public function getCustomerIpAddress()
    {
        return $this->customerIpAddress;
    }

    /**
     * @param string $customerIpAddress
     */
    public function setCustomerIpAddress($customerIpAddress)
    {
        $this->customerIpAddress = $customerIpAddress;
    }

    /**
     * @return string
     */
    public function getCustomerUserAgent()
    {
        return $this->customerUserAgent;
    }

    /**
     * @param string $customerUserAgent
     */
    public function setCustomerUserAgent($customerUserAgent)
    {
        $this->customerUserAgent = $customerUserAgent;
    }

    /**
     * @return string
     */
    public function getSig()
    {
        return $this->sig;
    }

    /**
     * @param string $sig
     */
    public function setSig($sig)
    {
        $this->sig = $sig;
    }
}
