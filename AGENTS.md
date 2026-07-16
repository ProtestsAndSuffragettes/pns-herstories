# AGENTS.md

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
