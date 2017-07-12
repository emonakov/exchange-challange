<?php

namespace Exchange;

use Exchange\Service\ServiceInterface;

class Connector
{
    /**
     * @var \Exchange\Service\ServiceInterface
     */
    protected $_service;

    public function __construct(ServiceInterface $service)
    {
        $this->_service = $service;
    }

    public function getLatest(array $params = [])
    {
        return $this->_service->getLatest($params);
    }

    public function getHistorical(array $params)
    {
        return $this->_service->getHistorical($params);
    }

    public function getAvailableCurrency()
    {
        return $this->_service->getAvailableCurrency();
    }
}