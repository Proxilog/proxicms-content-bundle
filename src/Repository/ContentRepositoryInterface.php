<?php

namespace ProxiCMS\ContentBundle\Repository;

use ProxiCMS\ContentBundle\Entity\ContentInterface;

interface ContentRepositoryInterface
{
    public function findAllPublicIndexByIdentifier(): array;

    public function findOrCreateOneByIdentifier(string $identifier, ?string $value): ?ContentInterface;
}
