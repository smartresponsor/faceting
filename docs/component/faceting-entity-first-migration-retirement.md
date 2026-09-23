# Faceting entity-first migration retirement

## Decision

Faceting no longer treats Doctrine migrations as the owner of the facet definition schema. The Doctrine entity is the schema source for this component.

## Retired schema-first sources

- `Faceting/migrations/**`

## Entity-first coverage

The retired migration table `facet` is superseded by the entity-first `facet_definition` table mapped by `App\Faceting\Entity\FacetEntity`.

Migration metadata moved into Doctrine attributes:

- `uniq_facet_definition_code` on `facet_definition.code`
- `idx_facet_definition_visible_position` on `facet_definition.visible, facet_definition.position`
- explicit `type` length `32`

## Repository contract

Added `App\Faceting\RepositoryInterface\FacetRepositoryInterface` and wired `FacetRepository` to implement it.

## Objecting decision

The current migration owns only the existing compact `created_at` / `updated_at` columns. I did not inject Objecting embeddables here because that would rename or add system columns and create schema drift rather than retire the current migration. A later Objecting-wide field-pack pass should migrate the whole component consistently if the platform decides to replace these columns with Objecting audit embeddables.

## Legacy entity source

`Entity-src(6).zip` was checked. No old `Facet`/`Faceting` monolith with additional relations was present, so there were no legacy relations to restore.
