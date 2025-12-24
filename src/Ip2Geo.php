<?php

namespace Ip2Geo;

class Ip2Geo
{
    private string $apiKey;
    private int $timeout;
    private string $baseUrl = 'https://api.ip2geoapi.com/ip';

    public function __construct(string $apiKey = '', int $timeout = 60)
    {
        $this->apiKey = $apiKey;
        $this->timeout = $timeout;
    }

    /**
     * Perform IP lookup
     *
     * @param string|null $ip
     * @param array $options [format, callback]
     * @return array|string
     */
    public function lookup(?string $ip = null, array $options = [])
    {
        $format = $options['format'] ?? null;
        $callback = $options['callback'] ?? null;

        if ($callback && $format !== 'jsonp') {
            throw new \InvalidArgumentException(
                "callback can only be used when format is 'jsonp'"
            );
        }

        $params = [];

        if ($this->apiKey !== '') {
            $params['key'] = $this->apiKey;
        }

        if ($format) {
            $params['format'] = $format;
        }

        if ($callback) {
            $params['callback'] = $callback;
        }

        $url = $this->baseUrl;
        if ($ip) {
            $url .= '/' . urlencode($ip);
        }

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $context = stream_context_create([
            'http' => [
                'timeout' => $this->timeout,
                'ignore_errors' => true // allow reading 4xx/5xx bodies
            ]
        ]);

        $response = @file_get_contents($url, false, $context);

        // TRUE transport failure (no response at all)
        if ($response === false) {
            throw new \RuntimeException('Unable to reach Ip2Geo API');
        }

        // Default JSON ? decode but DO NOT judge
        if (!$format || $format === 'json') {
            $decoded = json_decode($response, true);

            if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new \RuntimeException('Invalid JSON response from API');
            }

            return $decoded;
        }

        // XML / YAML / JSONP ? raw response
        return $response;
    }
}
