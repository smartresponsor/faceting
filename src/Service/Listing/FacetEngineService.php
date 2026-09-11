<?php

declare(strict_types=1);

namespace App\Faceting\Service\Listing;

use App\Faceting\DTO\Listing\FacetAggregationBucketDTO;
use App\Faceting\DTO\Listing\FacetAggregationResultDTO;
use App\Faceting\DTO\Listing\FacetListingCriteriaDTO;
use App\Faceting\DTO\Listing\FacetListingResultDTO;
use App\Faceting\ServiceInterface\Listing\FacetEngineServiceInterface;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;

/**
 * Applies facet listing criteria and derives typed aggregation buckets for presentation consumers.
 */
final class FacetEngineService implements FacetEngineServiceInterface
{
    /**
     * Initializes the listing engine with the Faceting service that supplies available facet rows.
     */
    public function __construct(
        private readonly FacetServiceInterface $facetService,
    ) {
    }

    /**
     * Filters available facets by typed criteria and returns rows plus aggregation metadata.
     */
    public function resolve(FacetListingCriteriaDTO $criteria): FacetListingResultDTO
    {
        $items = $this->facetService->listDemoFacets()->items;

        $filtered = [];

        foreach ($items as $item) {
            if (null !== $criteria->type && $item->type !== $criteria->type) {
                continue;
            }

            if (null !== $criteria->visible && $item->visible !== $criteria->visible) {
                continue;
            }

            if (null !== $criteria->search && '' !== $criteria->search) {
                $needle = strtolower($criteria->search);

                if (
                    !str_contains(strtolower($item->code), $needle)
                    && !str_contains(strtolower($item->nameEntity), $needle)
                ) {
                    continue;
                }
            }

            $filtered[] = [
                'code' => $item->code,
                'nameEntity' => $item->nameEntity,
                'type' => $item->type,
                'visible' => $item->visible,
            ];
        }

        $result = new FacetListingResultDTO();
        $result->items = $filtered;
        $result->total = count($filtered);
        $result->aggregations = $this->buildAggregations($filtered);

        return $result;
    }

    /**
     * Counts facet type and visibility dimensions for the already filtered listing rows.
     *
     * @param list<array{code:string,nameEntity:string,type:string,visible:bool}> $items
     */
    private function buildAggregations(array $items): FacetAggregationResultDTO
    {
        $aggregation = new FacetAggregationResultDTO();

        $typeCounts = [];
        $visibilityCounts = [];

        foreach ($items as $item) {
            $type = $item['type'];
            $visibility = $item['visible'] ? 'visible' : 'hidden';

            $typeCounts[$type] = ($typeCounts[$type] ?? 0) + 1;
            $visibilityCounts[$visibility] = ($visibilityCounts[$visibility] ?? 0) + 1;
        }

        $this->sortBucketCounts($typeCounts);
        $this->sortBucketCounts($visibilityCounts);

        foreach ($typeCounts as $key => $count) {
            $bucket = new FacetAggregationBucketDTO();
            $bucket->key = $key;
            $bucket->count = $count;
            $aggregation->types[] = $bucket;
        }

        foreach ($visibilityCounts as $key => $count) {
            $bucket = new FacetAggregationBucketDTO();
            $bucket->key = $key;
            $bucket->count = $count;
            $aggregation->visibility[] = $bucket;
        }

        return $aggregation;
    }

    /**
     * Orders bucket counts by descending count and then ascending key for deterministic ties.
     *
     * @param array<string, int> $counts
     */
    private function sortBucketCounts(array &$counts): void
    {
        uksort(
            $counts,
            static function (string $left, string $right) use ($counts): int {
                $countComparison = $counts[$right] <=> $counts[$left];

                return 0 !== $countComparison ? $countComparison : $left <=> $right;
            },
        );
    }
}
