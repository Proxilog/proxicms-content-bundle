<?php

namespace ProxiCMS\ContentBundle\Entity;

interface ContentInterface
{
    public function getId(): ?int;

    public function getIdentifier(): string;

    public function setIdentifier(string $identifier): self;

    public function getName(): string;

    public function setName(string $name): self;

    public function getValue(): ?string;

    public function setValue(?string $value): self;

    public function isPublic(): bool;

    public function setPublic(bool $public): self;

    public function isTextEditor(): bool;

    public function setTextEditor(bool $textEditor): self;
}
