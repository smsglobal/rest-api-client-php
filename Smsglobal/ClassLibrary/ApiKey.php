<?php
namespace Smsglobal\RestApiClient;

/**
 * An object representing your REST API key
 *
 * @package Smsglobal\RestApiClient
 */
class ApiKey
{
    /**
     * Hash algorithm to use with hash_hmac. Use hash_algos() to get a list of
     * supported algos. SMSGlobal uses sha256
     * @var string
     */
    const HASH_ALGO = 'sha256';

    /**
     * API key
     * @var string
     */
    protected $key;

    /**
     * API secret
     * @var string
     */
    protected $secret;

    /**
     * Constructor
     *
     * @param string $key    API key
     * @param string $secret API secret
     */
    public function __construct($key, $secret)
    {
        $this->key = (string) $key;
        $this->secret = (string) $secret;
    }

    /**
     * Gets the API key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Gets the value to use for the Authorization header
     *
     * @param string $method     HTTP method (e.g. GET)
     * @param string $requestUri Request URI (e.g. /v1/sms/)
     * @param string $host       Hostname
     * @param int    $port       Port (e.g. 80, 443)
     * @param string $ext        Optional extra data. Not currently used
     * @return string
     */
    public function getAuthorizationHeader(
        $method,
        $requestUri,
        $host,
        $port,
        $ext = ''
    ) {
        $timestamp = time();
        $nonce = md5(microtime() . mt_rand());

        $hash = $this->hashRequest(
            $timestamp,
            $nonce,
            $method,
            $requestUri,
            $host,
            $port,
            $ext
        );

        $header = 'MAC id="%s", ts="%s", nonce="%s", mac="%s"';
        $header = sprintf($header, $this->key, $timestamp, $nonce, $hash);

        return $header;
    }

    /**
     * Hashes a request using the API secret, for use in the Authorization
     * header
     *
     * @param int    $timestamp  Unix timestamp of request time
     * @param string $nonce      Random unique string
     * @param string $method     HTTP method (e.g. GET)
     * @param string $requestUri Request URI (e.g. /v1/sms/)
     * @param string $host       Hostname
     * @param int    $port       Port (e.g. 80, 443)
     * @param string $ext        Optional extra data. Not currently used
     * @return string
     */
    protected function hashRequest(
        $timestamp,
        $nonce,
        $method,
        $requestUri,
        $host,
        $port = 80,
        $ext = ''
    ) {
        // Could use func_get_args() for this but it causes lint errors
        $string = array(
            $timestamp,
            $nonce,
            $method,
            $requestUri,
            $host,
            $port,
            $ext,
        );

        $string = sprintf("%s\n", implode("\n", $string));

        $hash = hash_hmac(self::HASH_ALGO, $string, $this->secret, true);
        $hash = base64_encode($hash);

        return $hash;
    }
}
