<?php

declare(strict_types=1);

namespace App\Doctrine;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Client;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class CurrentClientExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    public function __construct(
        private readonly Security $security
    ) {
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param \ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param \ApiPlatform\Metadata\Operation|null $operation
     * @param array<mixed> $context
     *
     * @return void
     */
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        Operation $operation = null,
        array $context = []
    ): void {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param \ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param array<mixed> $identifiers
     * @param \ApiPlatform\Metadata\Operation|null $operation
     * @param array<mixed> $context
     *
     * @return void
     */
    public function applyToItem(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $identifiers,
        Operation $operation = null,
        array $context = []
    ): void {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        $user = $this->security->getUser();

        if (User::class !== $resourceClass) {
            return;
        }

        if (!$user instanceof Client) {
            throw new UserNotFoundException();
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->andWhere(sprintf('%s.client = :current_user', $rootAlias));
        $queryBuilder->setParameter('current_user', $user->getId()?->toBinary());
    }
}
