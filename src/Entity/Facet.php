<?php

declare(strict_types=1);

namespace App\Faceting\Entity;

use App\Faceting\Enum\FacetType;
use App\Faceting\Repository\FacetRepository;
use App\Faceting\ValueObject\Facet\FacetCode;
use App\Faceting\ValueObject\Facet\FacetName;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacetRepository::class)]
#[ORM\Table(
    name: 'facet',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_facet_code', columns: ['code']),
    ],
    indexes: [
        new ORM\Index(name: 'idx_facet_visible_position', columns: ['visible', 'position']),
    ],
)]
final class Facet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $nameEntity;

    #[ORM\Column(length: 32, enumType: FacetType::class)]
    private FacetType $type;

    #[ORM\Column]
    private bool $visible;

    #[ORM\Column]
    private int $position;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    public function __construct(FacetCode $code, FacetName $nameEntity, FacetType $type, bool $visible = true, int $position = 0)
    {
        $now = new \DateTimeImmutable();

        $this->code = $code->toString();
        $this->nameEntity = $nameEntity->toString();
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
        return new FacetName($this->nameEntity);
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

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function rename(FacetName $nameEntity): void
    {
        $this->nameEntity = $nameEntity->toString();
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
        $this->updatedAt = new \DateTimeImmutable();
    }
}
