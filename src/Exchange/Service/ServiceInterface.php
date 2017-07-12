<?php

namespace Exchange\Service;

interface ServiceInterface
{
    public function getLatest(array $params = []): array;

    public function getHistorical(array $params): array;

    public function getAvailableCurrency(): array;
}