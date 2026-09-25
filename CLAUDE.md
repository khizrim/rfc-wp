# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

Landing site for Robot Fight Club Russia (https://rfc.khizrim.online): a WordPress install run in Docker, where the only code under version control is the custom theme in `themes/rfc-wp/` plus the Docker/Makefile tooling around it. WordPress core, plugins, uploads and the DB volume are not tracked (`plugins/`, `uploads/`, `data/` are gitignored); their snapshots live in `export/` (`backup.sql.gz`, `plugins.tgz`, `uploads.tgz`). Content, UI strings, code comments and the README are in Russian; commit messages are in English.

There is no build step, bundler, linter or test suite. PHP, CSS and JS in the theme are served as-is.

## Local development

Requires a `.env` in the repo root (the Makefile `include`s it and fails without it). Set `DOCKERFILE=local.Dockerfile` for the Xdebug-enabled image. Note that `wp-config.php` reads the salts as `WP_AUTH_KEY`, `WP_SECURE_AUTH_KEY`, etc. (with a `WP_` prefix), unlike the example in README.

- `make setup`: start containers, install WP if needed, restore DB + uploads from `export/`, unpack and activate plugins from `export/plugins.tgz`, delete default themes/plugins.
- `make up` / `make down` / `make logs`
- `make backup` (alias `extract-data`): dump DB to `export/backup.sql.gz` and archive uploads. `make extract` also re-archives `plugins/`.
- `make restore`, `make sync-plugins`
- `make shell` / `make dbshell`; WP-CLI runs as `docker-compose exec -T rfc-wp wp ... --allow-root`.
- `make reset` and `make doom` delete `data/`, `plugins/`, `uploads/` (doom also removes volumes). Don't run them without being asked.

Site is on http://localhost:3000; MariaDB on 3306. `docker-compose.yml` bind-mounts `themes/`, `plugins/`, `uploads/` and `wp-config.php` into the container, so theme edits are live.

## Deployment

`.github/workflows/deploy.yml` runs on push to `master` and **only FTP-uploads `themes/rfc-wp/`** to `/wp-content/themes/rfc-wp/` on the server. (The README's description of DB backup and container restarts is out of date.) Anything outside the theme folder, including DB content, ACF field groups, plugins and `wp-config.php`, is not deployed by CI.

## Theme architecture (`themes/rfc-wp/`)

`functions.php` is the hub: it `require`s the modules below and does all asset enqueueing.

- **ACF Pro is a hard dependency.** Nearly all content comes from `get_field()`: block fields, CPT fields, and site-wide settings from the ACF options page (`get_field('phone_number', 'option')`, social links, `age_limit`, etc. in `header.php`/`footer.php`). Field groups are defined in the database via the ACF admin, not in code (the only exception is the SmartCaptcha options page registered in `integrations/yandex-smartcaptcha.php`). So a field referenced in a template may only exist in the DB dump.
- **Blocks** (`blocks/<name>/`): each is an ACF block with `block.json` (name `acf/rfc-<name>`, `acf.renderTemplate: render.php`), `render.php`, and a `style.css` loaded via `block.json`. Adding a block requires adding its folder *and* adding its name to `rfc_get_block_list()` in `functions.php`; that list drives both registration and the `allowed_block_types_all` whitelist (custom blocks plus a handful of core text/image blocks).
- **Custom post types** (`post-types/`): `mentor`, `robot`, `camp_shift`.
- **Camp-shift picker**: `front-page.php` renders the shift filter (city/date/etc. selects built from all `camp_shift` posts' ACF fields) and the registration modal. `scripts/filter.js` (jQuery) calls the `admin-ajax.php` actions in `ajax/shift-handlers.php` (`get_default_shift`, `get_shift_by_field`, `filter_shifts`, `get_available_options`), which return shift data as JSON. Only shifts with ACF `visible = 1` are shown.
- **Forms**: Contact Form 7, embedded via `do_shortcode` with hardcoded form IDs in `front-page.php` (registration) and `footer.php` (callback); the `trial-form` block takes its shortcode from an ACF field. `integrations/yandex-smartcaptcha.php` injects the Yandex SmartCaptcha widget via `wpcf7_form_elements` and validates the token server-side in `wpcf7_spam`; keys live on the "SmartCaptcha" ACF options page.
- **`typo_process()`** (typography cleanup) is called unguarded in `ajax/shift-handlers.php` and `blocks/how-it-was/render.php` but is not defined in this repo or in `export/plugins.tgz`; it comes from a plugin installed on the server. Locally those code paths fatal unless it's provided.
- **Styles**: `styles/index.css` is the single enqueued stylesheet (cache-busted by `filemtime`) and pulls everything else in with `@import` (vendor normalize/fonts, `global/`, per-section folders). Block-specific CSS lives beside each block instead. Class names follow BEM (`rfc-hero__container`, `footer__link`).
- **Scripts** (`scripts/`): plain vanilla JS, one file per behavior, enqueued in `functions.php`. Swiper 8 is loaded from unpkg and the slider scripts only when `has_block()` finds the robots/mentors/how-it-was blocks on the page.

## Conventions

- `.editorconfig`: 2-space indent, LF, max line length 80.
- Theme functions are prefixed `rfc_` (some older ones aren't).
- Commit messages use Conventional Commit prefixes (`feat:`, `fix:`, `style:`).
