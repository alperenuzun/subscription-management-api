<?php

namespace App\Service\Provider;

use App\Schema\ProviderResponseSchema;
use App\Service\Interfaces\ProviderRequestInterface;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

class IosProviderRequest extends AbstractProviderRequest implements ProviderRequestInterface
{
    private const IOS_URL = 'http://localhost:8080/ios/check-subscription';

    public function checkSubscription(string $receipt): ?ProviderResponseSchema
    {
        $response = $this->sendRequest(self::IOS_URL, $receipt);

        return $this->parseResponse($response);
    }

    protected function parseResponse(ResponseInterface $response): ?ProviderResponseSchema
    {
        if ($response->getStatusCode() === Response::HTTP_OK) {
            $result = $response->toArray();

            if (!isset($result['status']) || !isset($result['expire_date']) || !isset($result['expire_date']['date'])) {
                return null;
            }

            return (new ProviderResponseSchema())
                ->setStatus((bool)$result['status'])
                ->setExpireDate(new DateTime($result['expire_date']['date']));
        }

        return null;
    }
}
