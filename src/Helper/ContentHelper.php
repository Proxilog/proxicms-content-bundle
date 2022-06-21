<?php

namespace ProxiCMS\ContentBundle\Helper;

use ProxiCMS\ContentBundle\Entity\ContentInterface;
use ProxiCMS\ContentBundle\Repository\ContentRepositoryInterface;

class ContentHelper implements ContentHelperInterface
{
    public function __construct(protected ContentRepositoryInterface $contentRepository)
    {
    }

    /**
     * Récupèrer ou créer la variable en BDD à partir du slug
     */
    public function getOneByIdentifier(string $identifier, string $value = null): ?ContentInterface
    {
        return $this->contentRepository->findOrCreateOneByIdentifier($identifier, $value);
    }

    /**
     * Fonction raccourcie utile (pratique pour Twig)
     */
    public function getValueByIdentifier(string $identifier): ?string
    {
        return $this->getOneByIdentifier($identifier)->getValue();
    }
}
