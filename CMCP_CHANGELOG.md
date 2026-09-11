# CMCP Execution Journal

## engine-20260911142727-faceting-8b5eb5

### Iteration 1 — reconnaissance and baseline

- Scope: `D:\PhpstormProjects\www\Faceting` only; sibling repositories are read-only contract sources.
- Current branch: `master`; baseline worktree is materially dirty (94 status entries) with an in-progress Faceting canonization/rename wave. Existing changes are preserved and treated as the current execution tree, not reverted.
- Read: Faceting `AGENTS.md`, `README.md`, `composer.json`, architecture manifesto, manifests, routes/services/validator config, representative Entity source, PHPUnit config, Git status/diff.
- Mandatory dependency contour read: Objecting, Cruding, Viewing, Interfacing `AGENTS.md`, `README.md`, and `composer.json` where present.
- Canonization consulted: architecture README, guard matrix, Canon000 Component Prefix, Canon001 Technical Role First, Canon003 DTO Is Explicit, Canon004 Subject Folder Placement, Canon012 Typed Boundary Contract.
- Gating consulted: root `AGENTS.md`, `README.md`, `composer.json`; local `.gating/` is present in the target tree and will be used as executable enforcement.
- Target-to-canon mapping: Faceting PHP subject prefix is `Facet*`; technical role must precede business context; DTO path/casing/suffix is `src/DTO/**/**/*DTO.php`; early `Facet/` subject folders under role roots are non-canonical unless an explicit exception applies; stable internal boundary shapes should be typed.
- Objecting mapping: `Facet` currently owns local `createdAt`/`updatedAt`; Objecting owns canonical audit/version system fields, so lifecycle duplication must be reviewed before RC.
- Cruding mapping: generic CRUD controllers/routes must remain outside Faceting; Faceting may own true business/API faceting operations.
- Viewing/Interfacing mapping: final rendering/shell ownership stays outside Faceting; Faceting may produce typed neutral presentation contracts/responders but must not absorb shared rendering infrastructure.
- Dependency gap: development `composer.json` currently declares Objecting and Interfacing, but not mandatory Cruding and Viewing path/package dependencies.
- Namespace defect: `config/validator/faceting_validation.yaml` currently references `App\Dto\...`, outside the Faceting PSR-4 root.
- Baseline PHP syntax: changed/untracked PHP lint passed.
- Baseline Composer validation: structurally valid; strict mode fails on unbound `*@dev` dependency warnings.

### Selected RC-critical workstream

Complete the current canonical rename/topology migration, repair dependency/runtime and namespace defects, remove duplicated system-field ownership where safely supported by Objecting, then prove container/config/tests/Gating acceptance.

### Growth track (non-blocking)

- Preserve mature faceting semantics as post-RC growth: useful alternative facet counts, range facets, deterministic bucket ordering, and scalable aggregation strategies; do not block this RC on search-engine parity while correctness/canon debt remains.

## engine-20260911205102-faceting-6b5952

### Iteration 1 — reconnaissance and baseline

- Execution plane: Console MCP against `D:\PhpstormProjects\www\Faceting`; no container/GitHub substitution for local repository work.
- Branch baseline: `master` at `b5851bed2592ae6939df6271a047b9c415365642`, ahead of `origin/master` by 3 commits, with 115 dirty status entries from the active Faceting canonization wave. Existing work is preserved and continued, not reverted.
- Target docs/contracts read: `AGENTS.md`, `README.md`, `composer.json`, `composer.prod.json`, architecture manifesto, manifests, `.gating/config/profile.yaml`, representative Entity/Repository/DTO/Form/Builder/Responder/Service code and config.
- Mandatory dependency contour read: Objecting, Cruding, Viewing, Interfacing `AGENTS.md`, `README.md`, Composer manifests and available manifests; all four are declared in Faceting development and production Composer contracts, with local path repositories using symlinks in development.
- Canonization consulted as normative text: `Canon000ComponentPrefixRule`, `Canon001TechnicalRoleFirstRule`, `Canon003DtoIsExplicitRule`, `Canon004SubjectFolderPlacementRule`, `Canon012TypedBoundaryContractRule`, plus guard matrix and canonical rules journal. Gating consulted as executable companion.
- Canon mapping: `Faceting -> Facet*`; technical role first; DTOs under exact `src/DTO` with `DTO` suffix; component subject folders may not appear prematurely except documented Entity infrastructure; stable service/builder/responder contracts should be typed.
- Objecting mapping: `Facet` now composes `ObjectAuditEmbeddableTrait` / `ObjectAuditedInterface`; local audit timestamp duplication has been removed in the active tree.
- Cruding mapping: no generic CRUD controllers are present; Faceting retains true management/listing behavior only.
- Viewing/Interfacing mapping: Faceting owns neutral facet/query contracts and response shaping, not shared template/rendering/shell infrastructure.
- Market/open-source baseline: mature faceting surfaces expose bucket counts and range facets; Elastic implements facets through bucket aggregations, while Typesense exposes facet counts/ranges and documents the need for useful alternative counts after filters. RC focus remains correctness/canon; engine-scale/disjunctive parity is growth work.
- Baseline Composer strict validation: manifest valid, strict fails only on unbound local `*@dev` dependency warnings.
- Baseline Gating: 54 rules; 2 hard failures, 3 warnings. Hard failures are (1) legacy tracked `faceting_*` YAML filenames coexisting with canonical `facet_*` replacements, and (2) incomplete `.gating` component profile missing `nameEntity`, `business_prefix`, and `database_prefix`. Typed-boundary and PHPDoc coverage remain bounded debt.

### Selected RC-critical workstream

Finish the in-progress canonical rename/config cutover, repair the Gating profile, retain required service bindings, run full static/runtime gates, then close typed-boundary or PHPDoc debt only where necessary for a coherent RC without speculative product expansion.

### Growth track (non-blocking)

Evaluate disjunctive/alternative facet counts, numeric range buckets, bucket pagination/sorting, and backend aggregation adapters after RC; keep these outside the current bounded hardening wave unless required by failing tests or contracts.

### Iteration 2 — material implementation

- Completed the active configuration cutover from legacy `faceting_*` YAML filenames to canonical `facet_*` filenames using the repository-local guarded rename script; canonical service config retains the `FacetRepositoryInterface` binding.
- Completed `.gating/config/profile.yaml` with Faceting identity, `Facet` business/subject prefix, `facet_` database prefix, and typed-layer requirements.
- Migrated the management URI and all known security/template/test callers from `/faceting/management/facets` to `/facet/management/facets`, satisfying canonical route-owner grammar.
- Gating moved from 2 hard failures to 0 hard failures after the cutover.

### Iteration 3 — verification and fix

- `composer phpstan`: PASS at level 8 across `src` and `tests`.
- `composer test`: PASS; unit 14/14 (50 assertions), integration 2/2 (11 assertions), functional 4/4 (27 assertions).
- `composer pipeline:local:full`: PASS; PHP syntax, YAML, Twig, Symfony container and all test suites green.
- `composer cs:check`: initially identified formatter-owned import ordering/line-ending issues; `composer cs:fix` applied the declared formatter and the subsequent `cs:check` passed.
- `composer doctrine:schema:validate`: PASS for Doctrine mapping; database sync intentionally skipped by the declared command.
- `composer doctrine:migrations:currentness`: PASS, no migrations to execute.
- `composer validate:prod`: PASS.
- `composer gating`: PASS with 0 failed rules. Remaining warnings at this point were typed internal array contracts, PHPDoc coverage below the advisory 70% threshold, and incomplete `.gitignore` IDE/OS-noise coverage.

### Iteration 4 — debt closure and integration

- Closed the deterministic `.gitignore` warning by adding IDE-state and OS-noise exclusions.
- Typed-boundary and PHPDoc findings remain semantic/advisory migration debt rather than runtime failures. They are not suppressed or weakened in the profile; they remain visible for an explicit typed-contract/documentation wave rather than introducing broad speculative DTO/API churn during this RC cutover.
