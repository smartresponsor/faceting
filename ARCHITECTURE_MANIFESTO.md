# Architecture Manifesto

- `App\\ => src/` only.
- No alternative root namespace.
- No `/Domain/` directory.
- No component wrapper folders inside the code tree.
- `src/Service/...` for implementations.
- `src/ServiceInterface/...` for interfaces.
- Interfaces never live under `src/Service/...`.
- Component-local services follow `Faceting{Name}Service`.
- Config files under `config/` use the `faceting_` prefix.
- DTO, Validator, Form and ValueObject flows are preferred where they strengthen the application.
