<?php
namespace Smsglobal\ClassLibrary\Http\Request;

use Smsglobal\ClassLibrary\Http\Response\Curl as Response;

/**
 * Makes a request using the cURL library
 *
 * @package Smsglobal\ClassLibrary\Http\Request
 */
class Curl implements Adapter
{
    /**
     * {@inheritdoc}
     */
    public function request(
        $url,
        $method = 'GET',
        array $headers = array(),
        $content = null
    ) {
        $curlHeaders = array();

        foreach ($headers as $header => $value) {
            $curlHeaders[] = sprintf('%s: %s', $header, $value);
        }

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $curlHeaders);

        if (null !== $content) {
            curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
        }

        return new Response($handle);
    }
}
