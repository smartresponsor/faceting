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
- Final formatter-tail fix: Symfony-generated `config/reference.php` is excluded from PHP-CS-Fixer source scanning and explicitly ignored together with the redundant local `.php-cs-fixer.dist.php` compatibility file; generated reference artifacts remain local-only.

### Iteration 5 — final acceptance and handoff

- Re-ran `composer cs:check`: PASS (0 files require fixes).
- Re-ran `composer pipeline:local:full`: PASS; PHP syntax, YAML, Twig, Symfony container and all 20 tests / 88 assertions are green.
- Re-ran `composer gating`: PASS with 0 failed rules, 2 advisory warnings, 0 suppressed; `.gitignore` and generated-reference rules are green.
- `composer validate --strict --check-lock`: manifest/lock are structurally valid; strict exit remains non-zero only for the intentional local `*@dev` sibling path dependency constraints. Production manifest JSON validation passes.
- Remaining advisory debt: Canon012 typed-boundary review for four internal array contracts and Canon031 PHPDoc coverage below 70%. These are visible, bounded, and intentionally deferred to a focused non-RC migration/documentation wave rather than being suppressed.
- Final Git integration must include the complete coherent Faceting canonization wave and this journal, followed by branch/upstream/worktree acceptance.

### Advisory debt hardening continuation

- Continuation branch: `hardening/faceting-advisory-debt` on the Console MCP local repository execution plane.
- Canon012 typed-boundary debt was already closed on this branch before the documentation wave: Gating reports configured internal Builder/Service/Responder roots expose typed return contracts. The hardening introduced dedicated DTOs for demo datasets, facet collections/items, management surfaces, and reports rather than preserving stable internal `array<string,mixed>` contracts.
- Canon031 PHPDoc debt was closed with meaningful English responsibility and behavior documentation on production `src/` types; no warning suppression, threshold override, test-only padding, or placeholder comments were used.
- Final Canon031 result: classes 32/42 (76.2%), methods 52/73 (71.2%), both above the canonical 70% threshold.
- Final Gating result: 54 rules, 0 failed, 0 warnings, 0 suppressed, 8 profile/context skips.
- Regression: PHPStan level 8 PASS; PHP-CS-Fixer check PASS (0/61 files); full Symfony pipeline PASS; unit 14/14 (50 assertions), integration 2/2 (11 assertions), functional 4/4 (27 assertions), total 20 tests / 88 assertions.
- Doctrine mapping validation PASS with database synchronization intentionally skipped by the declared command; migration currentness PASS with no migrations to execute; production Composer manifest validation PASS.
- This continuation closes the two advisory debts that remained after the RC integration. No new product feature or search-engine parity work was introduced.

### Growth continuation — deterministic aggregation ordering

- Started from `origin/master` at `e5f3e1f4be6a60ccada8ac0bb39c3b85e50f445c`, with Canon012 and Canon031 already green and no Gating warnings.
- Selected the first bounded post-RC maturity increment: deterministic aggregation bucket ordering without changing Faceting ownership or public typed contracts.
- `FacetEngineService` now orders buckets by count descending and then key ascending when counts tie, eliminating insertion-order-dependent results.
- Added unit coverage for equal-count type and visibility buckets; README documents the ordering guarantee.
- Verification: unit suite PASS (15 tests / 52 assertions), PHPStan level 8 PASS, full Symfony pipeline PASS (21 tests / 90 assertions), Gating PASS with 0 failures and 0 warnings.
- Remaining growth track after this increment: alternative/disjunctive counts, numeric range bucket semantics, bucket pagination/limits, and backend aggregation strategy abstraction.

## engine-20260912080230-faceting-873026

### Iteration 1 — reconnaissance and baseline

- Execution plane: Console MCP against `D:\PhpstormProjects\www\Faceting`; sibling repositories are read-only contract sources.
- Branch baseline: `growth/faceting-deterministic-buckets` at `ec9160a87fac90abb293bc64816b16476830bc09`, aligned with `origin/growth/faceting-deterministic-buckets`.
- Existing dirty state is confined to `.gating/` (15 entries). It is treated as shared/tooling drift and is not adopted into this Faceting change set without explicit provenance; product files are otherwise clean at baseline.
- Target contracts read: `AGENTS.md`, `README.md`, `composer.json`, `composer.prod.json`, architecture/product/CLI manifestos, active Faceting manifests, listing engine DTO/service/tests, PHPUnit configuration, Git branch/status, and prior CMCP journal.
- Mandatory application dependency contour read: Objecting, Cruding, Viewing, and Interfacing `AGENTS.md`, `README.md`, and `composer.json`; Faceting declares all four in development and production, with local path repositories and symlinks in development.
- Canonization consulted as normative text: architecture README plus Canon000, Canon001, Canon002, Canon003, Canon010, Canon012, Canon017, Canon019, Canon038, and the guard matrix. Gating root contracts were read as the executable enforcement companion.
- Target-to-canon mapping: `Faceting -> Facet*`; role-first topology; mirrored typed interfaces; explicit `DTO`; no alternative architecture roots; stable internal contracts remain typed; completed renames must update docs/manifests; active docs must match runtime; component-owned YAML filenames derive the `facet_` prefix from package subject token `faceting/facet`.
- Concrete drift found: runtime configuration already uses canonical `facet_*` filenames, but `ARCHITECTURE_MANIFESTO.md`, `README.md`, `manifest/faceting.acceptance-gates.yaml`, `manifest/faceting.canon.yaml`, and `manifest/faceting.non_normative.examples.yaml` still teach the superseded `faceting_` prefix / filenames.
- Market baseline: mature faceting systems expose deterministic bucket counts/order as a baseline and add capabilities such as range facets, facet-value limits/search, alternative/disjunctive counts, and scalable aggregation strategies. These remain growth work unless correctness requires them.

### Selected RC-critical workstream

Complete the config-prefix migration across authoritative Faceting documentation/manifests, add a regression assertion that current active metadata cannot reintroduce the retired `faceting_` config-filename convention, then run targeted and full repository gates without absorbing unrelated `.gating/` drift.

### Growth track (non-blocking)

- Alternative/disjunctive counts after an active facet filter.
- Numeric/range bucket semantics and explicit bucket limits/pagination.
- Backend aggregation strategy abstraction for larger datasets.

Что имеем? Current runtime is already on `facet_*`; the remaining defect is authoritative metadata drift.
Что осталось? Patch the active metadata, add the regression guard, verify gates, integrate only Faceting-owned files, and perform final acceptance.

### Iteration 2 — material implementation

- Updated active repository metadata from the retired `faceting_` config-filename convention to canonical `facet_` in README, architecture manifesto, acceptance gates, and canon manifest.
- Refreshed non-normative path examples to match the current role-first `Management/Facet` and `ValueObject/Definition/Facet` topology and `config/services/facet_services.yaml`.
- Added `FacetConfigurationConventionTest` to prevent active metadata from reintroducing the retired `faceting_` convention.

Что имеем? Runtime and active metadata now encode one `facet_*` model.
Что осталось? Run full verification, repair deterministic failures, then integrate the bounded change set.

### Iteration 3 — verification and fix

- `composer test:unit`: PASS, 20 tests / 67 assertions.
- `composer phpstan`: PASS at level 8 across `src` and `tests`.
- `composer cs:check`: initially failed only on formatter-owned line endings/comment alignment in the new test; `composer cs:fix` repaired that file and the re-run passed.
- `composer pipeline:local:full`: PASS; PHP/YAML/Twig/container lint plus unit/integration/functional suites green, total 26 tests / 105 assertions.
- `composer doctrine:schema:validate`: PASS for mapping; database sync intentionally skipped by the declared command.
- `composer doctrine:migrations:currentness`: PASS, no migrations to execute.
- `composer validate:prod`: PASS.
- `composer validate --strict --check-lock`: manifest/lock structurally valid; non-zero exit is limited to the existing unbound local `*@dev` sibling dependency warnings.
- `composer gating` and the Console MCP `gating` check are BLOCKED before rule execution because baseline `.gating/config/profile.yaml` is absent in the pre-existing shared-tooling dirty state. No Faceting-owned change caused or repaired that tooling drift.

Что имеем? All independent Faceting runtime/static/test gates are green; Gating is externally blocked by the baseline `.gating` profile deletion.
Что осталось? Commit and push only the Faceting-owned files, leaving all pre-existing `.gating` changes untouched, then inspect remote integration and final repository state.

### Iteration 4 — debt closure and integration

- Explicitly staged only the seven Faceting-owned files; no `.gating` path entered the index.
- Created signed commit `6530f1987d93b8148e7230f99fcb4f4457e00b36` (`fix: align faceting config metadata`).
- Commit hook re-ran PHP-CS-Fixer on the staged PHP test and found no changes required.
- `git push` through Console MCP was blocked by the repository safety guard because the worktree remains dirty with the same 15 pre-existing `.gating` entries. The branch is one commit ahead of its upstream.
- No `.gating` file was staged, reverted, moved, or otherwise mutated to bypass the guard. A PR cannot truthfully include the new commit until that commit is published.

Что имеем? The bounded Faceting fix is committed and isolated; remote publication is blocked only by preserved pre-existing tooling drift.
Что осталось? Re-run acceptance on committed HEAD, record final branch/upstream state, and hand off the exact integration blocker.

### Iteration 5 — final acceptance and handoff

- Re-ran `composer pipeline:local:full` on committed HEAD: PASS; PHP/YAML/Twig/container lint and unit/integration/functional suites are green, total 26 tests / 105 assertions.
- Re-ran `composer phpstan`: PASS at level 8 with no errors.
- Re-ran `composer cs:check`: PASS, 0 of 62 files require fixes.
- Gating remains non-executable because `.gating/config/profile.yaml` is absent in the baseline shared-tooling dirty state; both Composer and Console MCP gate paths independently confirmed the same blocker before rule execution.

### Continuous RC execution — integration tail closure

- Classified the 15-entry `.gating` dirty baseline as a coherent embedded Gating synchronization wave: Canon039/040 tooling, registry/calibration updates, PHPUnit owner tooling, and retirement of the former embedded root profile/severity files.
- Verified standalone `D:\PhpstormProjects\www\Gating` is clean and the embedded calibration suite passes.
- Accepted the tooling wave in signed commit `b6eaf88` (`chore: sync embedded gating tooling`), isolating it from Faceting product changes.
- Moved Faceting's consumer-specific profile to `manifest/faceting.gating-profile.yaml` and bound the Composer `gating` script to the installed `gating/gate` policy root rather than the retired embedded `.gating/config/profile.yaml` path.
- Added canonical PHPUnit coverage execution (`test:coverage`) with Xdebug path coverage and persistent `var/coverage/summary.txt` evidence preparation.
- Added direct Facet Entity lifecycle/state tests and the missing FacetCode/FacetName validation branches. Unit suite is green at 23 tests / 80 assertions; PHPStan level 8 is green.
- Gating now executes 56 rules with 0 failures. Canon039 is green. Canon040 remains advisory; the latest coverage evidence is partial because the full coverage run is currently blocked by a sibling Cruding runtime regression.
- Current external blocker: local Cruding service configuration imports missing source directories (`src/Routing/` and previously `src/Dispatcher/`). Consequently Faceting integration/functional bootstrap and `pipeline:local:full` cannot complete in the current shared workspace state. This is outside the Faceting write boundary.

Что имеем? Faceting's own Gating integration, unit coverage contract, static analysis, and unit regression surface are green; the former dirty-worktree blocker is resolved.
Что осталось? Commit this bounded Faceting hardening, push the clean branch, then perform remote/PR integration. The only runtime verification tail is the independently broken Cruding sibling.

### Continuous RC execution — final cross-component acceptance

- The apparent Cruding blocker was transient workspace drift during its active canonization wave. Current Cruding `config/services.yaml` no longer imports the retired `src/Dispatcher/` or `src/Routing/` roots, so no sibling mutation was required from the Faceting task.
- Re-ran `composer pipeline:local:full`: PASS; PHP/YAML/Twig/container lint plus unit/integration/functional suites are green (24 unit / 85 assertions, 3 integration / 15 assertions, 4 functional / 27 assertions).
- Added behavior-level repository coverage for immediate-flush `save(..., true)` / `remove(..., true)` and persisted-facet precedence in `FacetService::listDemoFacets()`.
- Re-ran canonical coverage: PASS, 31 tests / 127 assertions. Canon040 now passes at lines 90.6%, methods 80.3%, branches 88.5%.
- Re-ran Gating: 56 rules, 0 failed, 0 warnings, 0 suppressed; Canon039 and Canon040 both pass.
- Re-ran PHPStan level 8 and PHP-CS-Fixer check: PASS.

Что имеем? Faceting has a fully green local RC acceptance surface, including cross-component Symfony bootstrap and all current Gating coverage thresholds.
Что осталось? Commit/publish this final coverage closure and merge it into `master`; no known Faceting RC blocker remains.

## 2026-09-14 — Canon041–045 RC refresh

### Reconnaissance and baseline

- Scope: `D:\PhpstormProjects\www\Faceting` only for writes; Canonization, Gating, Objecting, Cruding, Viewing, Interfacing, Collectioning, and Tabling are read-only contract/dependency sources.
- Branch baseline: `hardening/faceting-canon040-acceptance` at `a93c4d0ce35132d08798cdca4a43d21e45aef0ba`, aligned with its upstream; 33 pre-existing dirty `.gating/` entries are preserved and excluded from the Faceting-owned patch set.
- Target read: `AGENTS.md`, `README.md`, development/production Composer manifests, Faceting Gating profile, current functional tests, route config, management Twig surface, prior CMCP journal, branch/status and live Gating output.
- Dependency contour read: Objecting, Cruding, Viewing, Interfacing `AGENTS.md`, `README.md`, and `composer.json`; Cruding currently requires Collectioning and Tabling through canonical `dev-master` local path contracts.
- Canonization normative text consulted directly: architecture README, guard matrix, rules journal, Canon018, Canon021, Canon022, Canon023, Canon024, Canon039, Canon040, Canon041, Canon042, Canon043, Canon044, Canon045.
- Target-to-canon mapping: `faceting/facet` maps to `App\\Faceting\\` plus `Facet*`; Faceting remains a standalone Symfony application and therefore requires the full direct platform dependency baseline; local first-party path dependencies use exact `dev-master` plus `options.versions` and root repository closure; functional/browser/UI tooling and reproducible behavioral coverage evidence are required alongside PHP executable coverage.
- Live Gating baseline: 61 rules, 4 failures, 2 warnings. Failures: Canon022 missing Collectioning/Tabling direct dependencies; Canon041 missing Symfony Test Pack, Panther, Playwright package/config; Canon043 current `*@dev`/missing `dev-master` path version identity; Canon045 missing Collectioning/Tabling path closure. Warnings: Canon031 contract PHPDoc 66.7%; Canon042 behavioral/UI evidence missing. Canon040 passes at 90.6% lines, 80.3% methods, 88.5% branches.
- Market/open-source baseline: mature faceting systems provide counted buckets/distributions and numeric ranges, with engine-specific strategies/limits. Alternative/disjunctive counts, range semantics, facet-value search/limits, and backend aggregation strategy remain growth work and do not block this RC hardening.

### Selected RC-critical workstream

Close Canon022/041/043/045 deterministically, materialize reproducible Canon042 behavioral/UI evidence with actual functional/browser surfaces, close the Canon031 documentation warning, then re-run Composer/static/runtime/Gating acceptance and integrate only Faceting-owned files.

### Growth track (non-blocking)

- Alternative/disjunctive facet counts under active filters.
- Numeric/range bucket semantics and explicit facet-value limits/search.
- Backend aggregation strategy abstraction for larger datasets.

Что имеем? RC blockers are now concrete dependency/testing/documentation contracts; Faceting executable coverage and current business behavior remain green.
Что осталось? Apply the bounded Composer/npm/test-evidence/PHPDoc hardening, regenerate locks, run full acceptance, and integrate the isolated Faceting change set.

### Implementation and verification result

- Development Composer topology now satisfies Canon022/043/045: Collectioning and Tabling are direct standalone dependencies; all local first-party packages use exact `dev-master`; every local path repository declares `symlink: true` plus matching `options.versions`; root stability is `dev` with `prefer-stable: true`; the production manifest includes Collectioning/Tabling without local path repositories.
- Composer lock/vendor were regenerated successfully. Cruding, Gating, Objecting, Viewing, Collectioning, and Tabling resolve through the canonical development identities; PHPUnit moved to 12.5.35, Panther 2.4.0 and Symfony Test Pack 1.2.0 were installed.
- Canon041 is materialized with repository-local Playwright 1.63, `playwright.config.js`, a real-browser Faceting management workflow spec, and Composer/npm execution scripts. `package-lock.json` is generated by npm.
- Canon042 producer source was added at `tools/coverage/facet-behavioral-ui-coverage.php`; it publishes explicit functional/behavioral/UI/critical eligible and covered identifiers only after the declared `test:behavioral-coverage` workflow runs.
- Canon031 was closed with meaningful repository-interface PHPDoc: final measured class coverage 33/42 (78.6%) and contract-method coverage 31/42 (73.8%).
- PHPUnit 12 unit suite passes: 24 tests / 85 assertions. PHPStan passes with no errors. PHP-CS-Fixer is clean after normalizing two pre-existing test-file line endings. `composer validate --strict --check-lock` passes. Composer audit reports no security advisories.
- Final Gating result: 61 rules, 0 failures, 2 warnings, 8 skipped. Canon022, Canon031, Canon041, Canon043, and Canon045 pass. Remaining warnings are Canon040 stale executable coverage and Canon042 missing behavioral/UI evidence.

### External RC blocker

- Canonical `dev-master` resolution exposes a current sibling incompatibility: Cruding `App\\Cruding\\Builder\\Resource\\CrudInterfacingProviderResourceBuilder` requires `App\\Tabling\\Service\\TableColumnMetadataBuilder`, but the current Tabling master provides no such service.
- `composer lint:container` fails deterministically on that missing sibling service. The same Symfony bootstrap failure blocks integration/functional tests and the Playwright web server.
- Because behavioral/browser execution is not green, `var/coverage/behavioral-ui.json` was deliberately not generated and Canon042 remains an honest warning. Full PHPUnit coverage cannot be refreshed either, so Canon040 correctly reports stale evidence.
- No Faceting-local compatibility alias or shadow Tabling service was introduced: that would move Cruding/Tabling ownership into Faceting and violate the task boundary.

Что имеем? Faceting-owned Canon022/031/041/043/045 work is complete, Composer/PHPStan/unit/style/security gates are green, and Gating has zero hard failures.
Что осталось? The RC evidence warnings can close only after the Cruding↔Tabling master contract is repaired in its owning repository; then rerun integration/functional/UI/coverage and the declared behavioral evidence producer.

## engine-20260921020651-faceting-c5efc9

### Reconnaissance and baseline

- Execution plane: Console MCP against `D:\\PhpstormProjects\\www\\Faceting`; sibling repositories remain read-only contract sources.
- Current branch: `hardening/faceting-canon040-acceptance` at `5be1a721ef138fec27c363c272083f5c75099822`, ahead of its upstream by one commit. The worktree contains a pre-existing embedded `.gating/` synchronization wave plus Composer/bundle/Playwright changes and untracked audit/UI artifacts; none are reverted or silently adopted.
- Target read: `AGENTS.md`, `README.md`, development Composer manifest, `PRODUCT_CAPABILITY_AUDIT.adoc`, current Facet Entity/value objects/listing DTOs/builders/services/tests, Gating profile, Playwright configuration, Git state, prior execution journal and configured scripts.
- Mandatory dependency contour read: Objecting, Cruding, Viewing, and Interfacing `AGENTS.md`, `README.md`, and `composer.json`; Faceting declares the canonical standalone dependency contour through local `dev-master` path repositories.
- Canonization consulted as normative text: guard matrix and rules journal plus Canon001, Canon003, Canon004, Canon012, Canon017, Canon022, Canon041, Canon042, Canon043, Canon044 and Canon045. Gating remains the executable mirror.
- Target-to-canon mapping: keep role-first Symfony topology under `App\\Faceting\\`; new transfer contracts use explicit `*DTO` types; stable internal boundaries stay typed; active documentation must describe runtime; Objecting lifecycle fields are consumed through `ObjectAuditEmbeddableTrait` and must not be duplicated locally; standalone dependency/test contracts remain unchanged.
- Product boundary mapping: Faceting owns facet/value/filter semantics and neutral aggregation contracts. Searching executes queries, Indexing builds index structures, Cataloging owns catalog master data/taxonomy, and Viewing/Interfacing own presentation. Faceting must not introduce backend search execution or taxonomy persistence.
- Current product baseline: `Facet` already uses the Objecting audit pack correctly and the prior local timestamp duplication is gone. Existing listing code has facet-definition filtering and deterministic counts, but there is no canonical typed facet-value contract, stable facet-value identifier contract, or reusable applied-filter contract. `PRODUCT_CAPABILITY_AUDIT.adoc` therefore still has M1 incomplete.
- Market/open-source baseline: mature commerce/search faceting uses stable facet/value keys, explicit filter eligibility, multi-value selection semantics, range predicates and counted aggregation buckets while keeping engine-specific query execution outside the semantic contract. RC implementation will establish the semantic contracts first; engine adapters remain outside Faceting.

### Selected RC-critical workstream

Implement M1 canonical facet/value/filter contracts with stable identifiers and explicit filterability/searchability semantics, prove them through unit/static/Gating checks, and update the product audit without introducing search execution or sibling persistence coupling.

### Growth track (non-blocking)

- M2: multi-select composition, numeric/date range contracts, localization and deterministic ordering metadata.
- M3: neutral aggregation/count exchange contracts consumable by Indexing/Searching plus storefront acceptance with Cataloging/Retailing.

Что имеем? The first factual product gap is M1 contracts, not Objecting cleanup.
Что осталось? Implement the M1 types/tests, run deterministic gates, repair in-scope failures, then continue to M2 while the repository remains green.

### Implementation and verification

- M1 complete in Faceting: added stable `FacetValueIdentifier`, typed definition/value contracts, filterable/searchable eligibility and `FacetFilterDTO` with explicit `Any`/`All` multi-select semantics.
- M2 complete in Faceting: added numeric/date range filter contracts, normalized localized-label contract and deterministic non-negative position metadata.
- M3 contract complete in Faceting: added backend-neutral aggregation request, stable-value bucket and result/count contracts. No search or index executor was introduced.
- Canon hardening completed while implementing the audit: removed the project repository dependency from `Facet`; moved Doctrine manager operations behind `FacetRepositoryInterface`; migrated Doctrine mapping to class-level `UniqueConstraint`/`Index`; replaced deprecated string sort directions with `SortDirection`.
- `PRODUCT_CAPABILITY_AUDIT.adoc` now reflects implemented M1/M2 and M3 contract status; Objecting duplication debt was corrected as stale because `Facet` already consumes `ObjectAuditEmbeddableTrait`.
- Cross-component acceptance reconnaissance: Searching, Indexing, Cataloging and Retailing currently declare neither `faceting/facet` nor imports under `App\\Faceting\\`. Their consumer/storefront integration therefore cannot be truthfully completed inside the Faceting write boundary; it remains an owning-repository integration tail.
- Full Symfony pipeline PASS: PHP/YAML/Twig/container lint, 59 unit tests, 3 integration tests and 4 functional tests. Dedicated coverage run PASS: 66 tests / 183 assertions; Canon040 evidence 93.6% lines, 82.3% methods, 84.9% branches.
- Behavioral evidence PASS: integration 3/3, functional 4/4 and Playwright 2/2 real-browser flows; Canon042 functional 2/2, behavioral 2/2, UI 2/2 and critical 1/1.
- Static/release checks PASS: PHPStan level 8, PHP-CS-Fixer dry run, Composer strict/check-lock validation, Composer security audit, Doctrine mapping validation and migration currentness, production manifest JSON validation.
- Final Gating result for this pass: 65 rules, 0 failed, 0 warning, 0 suppressed, 8 skipped.

Что имеем? Faceting-owned M1/M2 and M3 contract work is production-implemented and all local deterministic/behavioral gates are green.
Что осталось? Consumer/storefront adoption and acceptance must be implemented in Searching/Indexing/Cataloging/Retailing because those repositories currently have no Faceting dependency; preserve that cross-repository tail rather than duplicating it locally.

## 2026-09-23 — Physical table prefix acceptance

- Baseline: `hardening/faceting-canon040-acceptance` at `fe769e2`, aligned with upstream; pre-existing `.gating/README.md` edit preserved. Read root instructions, Composer manifests, Facet Entity and schema note, helper contracts, Canonization Canon040/Canon042 and Gating output.
- Target mapping: Faceting `App\\Faceting\\` and `Facet*` naming pass; direct Objecting, Cruding, Viewing, Interfacing, Collectioning and Tabling declarations and local symlink closure pass. Canon040/042 evidence is green. Gating's database prefix rule requires `facet_` for the mapped table; consumer `.gating/` must contain artifacts only.
- Selected RC repair: map `FacetEntity` to `facet_definition` and update its entity-first schema note. Risk: existing local databases built from the old `facet` table need deliberate rebuild or data migration; no destructive database operation is performed here.
- Remaining separate RC debt: tracked executable Gating copy under `.gating/` currently fails Canon052; identify exact tracked paths and retire them without touching the pre-existing README edit. Run final gates after isolated removal.
- Growth: disjunctive counts, bucket limits/search and backend-specific execution remain outside this RC repair.

Что имеем? Symfony pipeline, PHPStan and strict Composer validate pass at baseline; two Gating failures are identified, with the table mapping corrected.
Что осталось? Verify the mapping change and remove the tracked embedded Gating copy safely, then repeat Gating and integration checks.
- Follow-up: renamed physical unique/index names to `uniq_facet_definition_code` and `idx_facet_definition_visible_position` after the initial integration run exposed SQLite's global index-name collision with the retired table.
- Verification after repair: all 60 unit, 3 integration and 4 functional tests pass; Doctrine mapping validation passes (database synchronization intentionally skipped). Gating database.table_prefix passes; Canon052 alone remains failed due to the pre-existing embedded executable copy under `.gating/`. Existing `.gating/README.md` edit remains untouched by this task.

Что имеем? The Faceting-owned table-prefix repair passes the affected test suites and gate rule.
Что осталось? Retire the exact embedded Gating files after provenance and deletion inventory; rerun Gating to close Canon052, then verify local database migration/rebuild strategy before production deployment.


