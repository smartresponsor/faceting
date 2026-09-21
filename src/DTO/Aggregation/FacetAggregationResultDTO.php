<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Aggregation;

use App\Faceting\ValueObject\Definition\Facet\FacetCode;

/**
 * Neutral counted-facet result contract consumed across search/index/storefront boundaries.
 */
final readonly class FacetAggregationResultDTO
{
    /**
     * @var list<FacetAggregationBucketDTO>
     */
    public array $buckets;

    /**
     * @param list<FacetAggregationBucketDTO> $buckets
     */
    public function __construct(
        public FacetCode $facetIdentifier,
        array $buckets,
        public int $matchedResourceCount,
    ) {
        if ($matchedResourceCount < 0) {
            throw new \InvalidArgumentException('Matched resource count must not be negative.');
        }

        $seen = [];
        foreach ($buckets as $bucket) {
            $key = $bucket->valueIdentifier->toString();
            if (isset($seen[$key])) {
                throw new \InvalidArgumentException(sprintf('Facet aggregation contains duplicate value identifier "%s".', $key));
            }

            if ($bucket->count > $matchedResourceCount) {
                throw new \InvalidArgumentException('Facet bucket count must not exceed matched resource count.');
            }

            $seen[$key] = true;
        }

        $this->buckets = $buckets;
    }
}
