# Faceting Gating integration

Faceting consumes the `gating/gate` Composer package. Its `composer.json` provides the local `../Gating` path repository with `symlink: true`, while `composer.prod.json` resolves the published package through VCS.

Run `composer gating` to execute the shared Gating rules using `config/facet_gating_profile.yaml`. The canonical CLI comes from the installed package; Faceting does not keep a local executable copy.

The Faceting `.gating/` directory is reserved for generated reports, evidence, cache and checksums. Component profile values belong under Symfony `config/`; executable rules, policy and schemas belong to the Gating repository/package.

Canon-linked executable rules use the matching `CanonNNN<SemanticName>Rule` identity when they enforce the corresponding textual Canonization rule. Generic rules remain separate unless they provide the declared coverage. See the installed Gating package's `docs/canon-rule-contract.md`.
