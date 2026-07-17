# PNS Herstories

Project-owned Herstories content model for Protests and Suffragettes.

## Scope

- Plugin path: `app/public/wp-content/plugins/pns-herstories/`
- Custom post type: `herstory`
- First taxonomy: `herstory_tag`
- CPT archive: `/herstories/`
- CPT single entries: `/herstories/{slug}/`

The plugin owns Herstories functionality: CPT registration, taxonomies,
editor defaults, ordering, permalink lifecycle, admin conveniences, and future
migration helpers.

The active PNS theme owns final templates, CSS, visual layout, and regression
coverage.

The legacy `/herstories/` page family was the landing experience during v1
migration. After cutover, the plugin-owned CPT archive owns `/herstories/` and
single Herstory entries live below that archive route.

## Agent workflow

See [`AGENTS.md`](AGENTS.md) for the repository workflow, local Dex planning
state, PHP verification, and Release Please conventions. The project-scoped
WordPress skills are available under `.codex/skills/`.

## V1 Behavior

- Adds a `Herstories` admin menu.
- Registers the `herstory` post type.
- Registers the `herstory_tag` taxonomy.
- Starts new Herstory entries from an editable block scaffold.
- Uses `menu_order` plus title as the default editorial ordering model.
- Provides query helpers for ordered lists and previous/next navigation.
- Orders the CPT archive and Herstory tag archives by `menu_order` plus title.

## Guardrails

- Do not add broad front-end CSS to this plugin.
- Do not use blog categories for Herstory organization.
- Do not migrate existing page content without a rollback export.
- Keep presentation in the active PNS theme.
