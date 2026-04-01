<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\FacetType;
use App\Repository\FacetRepository;
use App\ValueObject\Facet\FacetCode;
use App\ValueObject\Facet\FacetName;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacetRepository::class)]
#[ORM\Table(name: 'facet')]
final class Facet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, unique: true)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(enumType: FacetType::class)]
    private FacetType $type;

    #[ORM\Column]
    private bool $visible;

    #[ORM\Column]
    private int $position;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;

    #[ORM\Column]
    private DateTimeImmutable $updatedAt;

    public function __construct(FacetCode $code, FacetName $name, FacetType $type, bool $visible = true, int $position = 0)
    {
        $now = new DateTimeImmutable();

        $this->code = $code->toString();
        $this->name = $name->toString();
        $this->type = $type;
        $this->visible = $visible;
        $this->position = $position;
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): FacetCode
    {
        return new FacetCode($this->code);
    }

    public function getName(): FacetName
    {
        return new FacetName($this->name);
    }

    public function getType(): FacetType
    {
        return $this->type;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function rename(FacetName $name): void
    {
        $this->name = $name->toString();
        $this->touch();
    }

    public function changeType(FacetType $type): void
    {
        $this->type = $type;
        $this->touch();
    }

    public function changeVisibility(bool $visible): void
    {
        $this->visible = $visible;
        $this->touch();
    }

    public function reposition(int $position): void
    {
        $this->position = $position;
        $this->touch();
    }

    private function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
