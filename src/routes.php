<?php
$app->get('/', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, $args) {
    $queryParams = $request->getQueryParams();
    $latest = $this->connector->getLatest($request->getQueryParams());
    $currencies = $this->connector->getAvailableCurrency();
    $selectedDate = isset($queryParams['history']) ? $queryParams['history'] : null;
    if ($selectedDate) {
        $latest = $this->connector->getHistorical($queryParams);
    }
    return $this->renderer->render($response, 'index.phtml', [
        'latest' => $latest,
        'currencies' => $currencies,
        'selectedDate' => $selectedDate
    ]);
});
