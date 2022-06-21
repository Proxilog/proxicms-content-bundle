<?php

namespace ProxiCMS\ContentBundle\Twig;

use ProxiCMS\ContentBundle\Entity\ContentInterface;
use ProxiCMS\ContentBundle\Helper\ContentHelperInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ContentExtension extends AbstractExtension
{
    public function __construct(protected ContentHelperInterface $contentHelper)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('proxicms_content_obj', [$this, 'getOneByIdentifier']),
            new TwigFunction('proxicms_content_val', [$this, 'getValueByIdentifier']),
        ];
    }

    public function getOneByIdentifier(string $identifier): ContentInterface
    {
        return $this->contentHelper->getOneByIdentifier($identifier);
    }

    public function getValueByIdentifier(string $identifier): ?string
    {
        return $this->contentHelper->getValueByIdentifier($identifier);
    }
}
