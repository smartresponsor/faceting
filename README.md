# Faceting

Owner-oriented Faceting component workspace.

## Manifest pack

This repository now carries a strict manifest pack intended to govern all future Symfony-oriented implementation work.

Files:

- `manifest/faceting.canon.yaml`
- `manifest/faceting.non_normative.examples.yaml`
- `manifest/faceting.acceptance-gates.yaml`
- `manifest/faceting.execution-roadmap.yaml`

## Core invariant

The component must keep a single Symfony root code tree only:

- namespace root: `App\\`
- code root: `src/`

No alternative root namespace is allowed.

## Mandatory structural direction

- no `/Domain/`
- no repository/component wrapper directories such as `Faceting`, `Catalog`, `Cataloging` inside the code tree
- service implementations in `src/Service/...`
- service interfaces only in mirrored `src/ServiceInterface/...`
- component-local services must start with `Faceting` and end with `Service`
- configuration files under `config/` must start with the `faceting_` prefix

## Scope of the manifest pack

The manifest pack is intentionally strict about:

- namespace normalization
- folder structure normalization
- service/interface mirroring
- configuration naming
- DI/container alignment
- DTO / ValueObject / Validator usage
- Form / Twig / Bootstrap management flows
- Fixtures / Faker / CLI / demo management
- testing layers: unit, integration, functional, Panther, Playwright
- pipeline, security, reporting, browser automation, Chrome MCP compatibility

The manifests define mandatory rules, migration examples, acceptance gates, and an execution roadmap so that future code work can be implemented without architecture drift.
