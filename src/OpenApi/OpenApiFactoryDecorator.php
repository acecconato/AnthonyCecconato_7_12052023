<?php

declare(strict_types=1);

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\PathItem;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\OpenApi\Model\Response;
use ApiPlatform\OpenApi\OpenApi;
use ArrayObject;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator('api_platform.openapi.factory')]
class OpenApiFactoryDecorator implements OpenApiFactoryInterface
{
    public function __construct(
        private readonly OpenApiFactoryInterface $decorated
    ) {
    }

    /**
     * @param array<mixed> $context
     *
     * @return OpenApi
     */
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        $operation = new Operation(
            operationId: 'refreshToken',
            responses: [
                '200' => new Response(
                    description: 'Returns a new access token'
                ),
                '401' => new Response(
                    description: 'The refresh token is invalid or expired'
                ),
            ],
            summary: 'Refresh Token',
            requestBody: new RequestBody(
                description: 'Refresh token request',
                content: new ArrayObject([
                    'application/json' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'refresh_token' => ['type' => 'string']
                            ],
                            'required' => ['refresh_token']
                        ],
                    ],
                ]),
                required: true,
            ),
        );

        $refreshPathItem = new PathItem(
            post: $operation
        );

        $openApi->getPaths()->addPath('/auth/refresh', $refreshPathItem);

        return $openApi;
    }
}
