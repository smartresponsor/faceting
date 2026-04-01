# Faceting

Symfony-oriented application skeleton for the **Faceting** component.

Core invariant:

- `App\\ => src/`
- no `/Domain/`
- no component wrapper folders inside the code tree
- `src/Service/...` for implementations
- `src/ServiceInterface/...` for interfaces
- `faceting_` config prefix under `config/`

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
