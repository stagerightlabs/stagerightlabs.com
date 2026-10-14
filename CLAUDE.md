# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

A flat-file blog and home page for Stage Right Labs (Laravel 12, PHP 8.4, Tailwind 4 + Alpine CSP build via Vite). There is no database; content is markdown files in `storage/content/`.

## Commands

PHP runs only inside Docker (there is no host `php`). Use the `./ops.sh` wrapper from the repo root:

- `./ops.sh up -d` / `./ops.sh` (ps) — compose passthrough; the site is served at http://stagerightlabs.test
- `./ops.sh art <command>` — artisan (e.g. `./ops.sh art make:article my-slug`, `./ops.sh art purge`)
- `./ops.sh composer <args>` — composer in the `php` container
- `./ops.sh pnpm <args>` — pnpm in the `node` container (`pnpm dev`, `pnpm build`, `pnpm format`)
- `./ops.sh exec php vendor/bin/phpunit` — all tests (CI runs it with `--exclude-group skip`)
- `./ops.sh exec php vendor/bin/phpunit --filter it_can_read_front_matter` or pass a file path — single test
- `./ops.sh exec php vendor/bin/pint` — PHP formatting (CI runs this; `declare(strict_types=1)` is enforced)
- `./ops.sh exec php vendor/bin/phpstan analyse` — static analysis (larastan, level 8, over `app/` and `src/`)

Keep command output small:

- Pipe test/lint output through `| tail -15` (or `grep -E 'FAIL|Error|OK'`), and run a single file or `--filter` rather than the full suite when iterating.
- phpunit writes an HTML coverage report on every run (`.coverage/`); ignore it and don't read it.
- Never dump `composer.lock`, `pnpm-lock.yaml` or `vendor/`; for lock changes use `git diff --stat` or grep for specific `"version"` lines.
- Use `./ops.sh exec -T php ...` for non-interactive commands, and prefer `--no-ansi`/`-q` flags on composer and artisan.

Tests are split into `Domain` (unit-style tests of `src/`) and `Feature` suites. Fixtures live in `tests/stubs/`.

## Architecture

Two PSR-4 roots: `App\` (`app/`, thin HTTP/console layer) and `Blog\` (`src/`, the content engine).

**Content pipeline (`src/`)**: `Blog\Librarian\Librarian` (singleton, bound in `LibrarianServiceProvider` to `storage/content`) is the central service. It reads `*.md` files into immutable `Blog\Documents\Document` value objects, which are passed through transformers via `Document::pipe()`:

1. `Transformers\ParseFrontMatter` — splits YAML front matter (Symfony Yaml) off the body and returns a new populated `Document`. Invalid YAML is logged as a warning and the document is returned unparsed.
2. `Transformers\MarkdownConverter` — CommonMark → HTML (table of contents, heading permalinks, Tempest syntax highlighting).

The index (`Librarian::index()` → `Documents\Index`) is rebuilt from the files on every call; there is no on-disk index cache. `published()` is the set of documents with a `date`, used by the feed and sitemap. A document's front-matter `template` (default `article`) names the Blade view that renders it.

**HTTP (`app/Http/Controllers`, `routes/web.php`)**: single-action controllers. Articles, and static pages like `about`/`projects`/`resume`/`decks`, are all just markdown files looked up by slug/request path through `Librarian::fetch()` (404 if not in the index). So adding a page route means adding a `storage/content/<name>.md` file plus a `PageController` route. Individual slide decks are separate Blade views in `resources/views/decks/` served by `DeckController`.

**Caching/deploy**: responses are cached at Cloudflare rather than on disk; `artisan purge` clears the Cloudflare zone cache (needs `CLOUDFLARE_API_TOKEN` and `CLOUDFLARE_ZONE_ID`). The CSP uses a nonce (see the deck template), so inline scripts/styles in views need it.
