<?php

namespace ProxiCMS\ContentBundle\Helper;

use ProxiCMS\ContentBundle\Entity\ContentInterface;

interface ContentHelperInterface
{
    public function getOneByIdentifier(string $identifier, string $value = null): ?ContentInterface;

    public function getValueByIdentifier(string $identifier): ?string;
}
