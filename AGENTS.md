# AGENTS.md

## Project workflow

This is a standalone `ProtestsAndSuffragettes/pns-herstories` repository. It
owns the Herstories content model and administration behavior; the active PNS
theme owns site presentation. Do not change the declared WordPress or PHP
compatibility baseline without a separate product-support decision.

Use the project-scoped WordPress skills in `.codex/skills/` to classify and
carry out WordPress work. Keep changes focused on the plugin’s content model,
not theme templates or broad front-end styling.

## Development and verification

Run the repository's PHP syntax workflow locally when possible, and always run
PHP linting over changed plugin files before committing. This plugin does not
have generated JavaScript or CSS assets, so do not introduce an asset build or
asset-check hook without an actual runtime asset contract.

## Dex planning state

Dex is local agent-planning state, not project content. Use
`dex --storage-path .dex` for plans and executions when tracking is useful;
`.dex/` is ignored and must not be committed or synchronised externally.

## Commits

Use Conventional Commits. `feat:` and `fix:` are releasable through Release
Please; use `chore:`, `docs:`, `test:`, `build:`, or `ci:` for non-releasable
maintenance unless a release is deliberately intended.

## Release automation

This plugin is maintained in its own `ProtestsAndSuffragettes/pns-herstories`
repository. Use the global `$release-please` skill before configuring or
operating its release automation.

The repository-level Release Please manifest keeps the plugin header and
`PNS_HERSTORIES_VERSION` constant in `pns-herstories.php` aligned with
`VERSION`. The manifest must explicitly update every nonstandard WordPress
version source.

Preserve the existing `0.1.0` version in the bootstrap manifest and validate
the generated release PR before merging it.
