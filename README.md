# Faceting

Symfony-oriented application skeleton for the **Faceting** component.

Core invariant:

- `App\\ => src/`
- no `/Domain/`
- no component wrapper folders inside the code tree
- `src/Service/...` for implementations
- `src/ServiceInterface/...` for interfaces
- `facet_` config prefix under `config/`

Current vertical slice:

- management route
- management controller
- Symfony form
- validator mapping
- Twig + Bootstrap UI
- mirrored service interfaces
- ValueObject normalization
- Doctrine persistence foundation
- Doctrine fixture foundation with dataset-service reuse
- CLI report, fixtures load, cleanup and demo reset surfaces
- unit coverage for normalization, dataset and reporting
- deterministic aggregation bucket ordering: count descending, then key ascending for ties
- stable facet/value identifiers separated from labels and catalog-owned external references
- typed facet eligibility and multi-select `Any`/`All` filter semantics
- numeric and immutable date range filter contracts with explicit bound inclusivity
- locale-normalized label and neutral ordering metadata contracts
- backend-neutral aggregation request/result/count contracts, including normalized facet-value query transport; Searching executes queries and Indexing builds index structures
