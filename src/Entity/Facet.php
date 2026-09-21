<?php

declare(strict_types=1);

namespace App\Faceting\Entity;

use App\Faceting\Enum\FacetType;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;
use App\Objecting\EntityInterface\ObjectAuditedInterface;
use App\Objecting\EntityTrait\Embeddable\ObjectAuditEmbeddableTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'facet')]
#[ORM\UniqueConstraint(name: 'uniq_facet_code', columns: ['code'])]
#[ORM\Index(name: 'idx_facet_visible_position', columns: ['visible', 'position'])]
/**
 * Represents the persistent facet definition together with its canonical audit lifecycle state.
 */
final class Facet implements ObjectAuditedInterface
{
    use ObjectAuditEmbeddableTrait;

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

    /**
     * Creates a facet from validated value objects and initializes canonical audit metadata.
     */
    public function __construct(FacetCode $code, FacetName $nameEntity, FacetType $type, bool $visible = true, int $position = 0)
    {
        $this->code = $code->toString();
        $this->nameEntity = $nameEntity->toString();
        $this->type = $type;
        $this->visible = $visible;
        $this->position = $position;
        $this->initializeObjectAudit();
    }

    /**
     * Returns the database identifier when Doctrine has assigned one to this facet.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns the validated facet code as its dedicated immutable value object.
     */
    public function getCode(): FacetCode
    {
        return new FacetCode($this->code);
    }

    /**
     * Returns the validated human-readable facet name as its dedicated value object.
     */
    public function getName(): FacetName
    {
        return new FacetName($this->nameEntity);
    }

    /**
     * Returns the configured facet type used by listing and aggregation behavior.
     */
    public function getType(): FacetType
    {
        return $this->type;
    }

    /**
     * Reports whether this facet is currently visible to listing consumers.
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * Returns the deterministic ordering position used for visible facet presentation.
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Renames the facet and records the modification through the canonical audit pack.
     */
    public function rename(FacetName $nameEntity): void
    {
        $this->nameEntity = $nameEntity->toString();
        $this->touch();
    }

    /**
     * Changes the facet classification and records the resulting audited modification.
     */
    public function changeType(FacetType $type): void
    {
        $this->type = $type;
        $this->touch();
    }

    /**
     * Changes facet visibility and records the resulting audited modification timestamp.
     */
    public function changeVisibility(bool $visible): void
    {
        $this->visible = $visible;
        $this->touch();
    }

    /**
     * Changes the listing position and records the resulting audited modification timestamp.
     */
    public function reposition(int $position): void
    {
        $this->position = $position;
        $this->touch();
    }

    /**
     * Delegates modification tracking to the canonical Objecting audit implementation.
     */
    private function touch(): void
    {
        $this->touchModified();
    }
}
