<?php

namespace Exchange\Service;

class Fixer implements ServiceInterface
{
    protected $_apiUrl;

    protected $_latestEndpoint;

    protected $_historicalEndpoint;

    public function __construct($apiUrl, $latestEndpoint, $historicalEndpoint)
    {
        $this->_apiUrl = $apiUrl;
        $this->_latestEndpoint = $latestEndpoint;
        $this->_historicalEndpoint = $historicalEndpoint;
    }

    public function getLatest(array $params = []): array
    {
        $url = $this->_apiUrl . $this->_latestEndpoint;
        $params = http_build_query($params);
        $data = file_get_contents($url . '?' . $params);
        return json_decode($data, true);
    }

    public function getHistorical(array $params): array
    {
        if (!$params['history']) return [];
        $url = $this->_apiUrl . $this->_historicalEndpoint;
        $date = $params['history'];
        unset($params['history']);
        $params = http_build_query($params);
        $data = file_get_contents($url . $date . '?' . $params);
        return json_decode($data, true);
    }

    public function getAvailableCurrency(): array
    {
        $data = $this->getLatest();
        return array_keys($data['rates']);
    }
}