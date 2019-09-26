<?php declare(strict_types=1);

namespace AsyncBot\Core\Http;

use Amp\Http\Client\Client as HttpClient;
use Amp\Http\Client\HttpException;
use Amp\Http\Client\Request;
use Amp\Http\Client\Response;
use Amp\Promise;
use AsyncBot\Core\Http\Exception\NetworkError;
use AsyncBot\Core\Http\Exception\UnexpectedJsonResponse;
use AsyncBot\Core\Http\Validation\JsonSchema;
use function Amp\call;
use function ExceptionalJSON\decode;

final class Client
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function requestJson(string $uri, JsonSchema $jsonSchema): Promise
    {
        return call(function () use ($uri, $jsonSchema) {
            $request = new Request($uri);

            /** @var Response $response */
            $response = yield $this->makeRequest($request);

            $responseData = decode(yield $response->getBody()->buffer(), true);

            if (!$jsonSchema->validate($responseData)) {
                throw new UnexpectedJsonResponse($request);
            }

            return $responseData;
        });
    }

    /**
     * @return Promise<Response>
     * @throws NetworkError
     */
    private function makeRequest(Request $request): Promise
    {
        return call(function () use ($request) {
            try {
                /** @var Response $response */
                $response = yield $this->httpClient->request($request);
            } catch (HttpException $e) {
                throw new NetworkError($request, 0, $e);
            }

            if ($response->getStatus() !== 200) {
                throw new NetworkError($request, $response->getStatus());
            }

            return $response;
        });
    }
}
