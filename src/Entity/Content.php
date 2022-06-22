<?php

namespace ProxiCMS\ContentBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ProxiCMS\ContentBundle\Repository\ContentRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContentRepository::class)]
#[ORM\Table(name: 'proxicms_content')]
#[Assert\EnableAutoMapping]
class Content implements ContentInterface
{
    public const CATEGORIES_DATA = ['contact', 'setting'];
    public const CATEGORIES_LABEL = ['Coordonnées', 'Réglages']; // Contact details / Settings

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $identifier;

    #[ORM\Column(type: Types::STRING, length: 160, nullable: true)]
    private ?string $category;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $value;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $public = false;

    /**
     * Enable the "textEditor" with EasyAdmin
     */
    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $textEditor = false;

    public function __construct(?string $identifier = null, ?string $name = null, ?string $value = null)
    {
        $this->identifier = $identifier ?? '';
        $this->name = $name ?? '';
        $this->value = $value ?? '';
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public static function getCategories(): array
    {
        return array_combine(self::CATEGORIES_DATA, self::CATEGORIES_LABEL);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    public function isTextEditor(): bool
    {
        return $this->textEditor;
    }

    public function setTextEditor(bool $textEditor): self
    {
        $this->textEditor = $textEditor;

        return $this;
    }
}
