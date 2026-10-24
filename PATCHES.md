# Fork patches

This fork is used by `dujiaokaFix` for the PHP 8.3 / Laravel 12 upgrade.

## Base

- Upstream: `jqhph/dcat-admin`, branch `2.0`
- Commit: `315658a8` (2025-06-25, includes Laravel 12 support)
- Package name stays `dcat/laravel-admin`, namespace stays `Dcat\Admin\`

## Backports

Backported from `woodynew/dcat-admin` `2.0` @ `971e230a` (tag `2.2.4`, 2026-09-03).
Only `src/` and `resources/` were taken; CI, README, CHANGELOG and Dusk test
changes were intentionally skipped.

- PHP 8.x compatibility (explicit nullable parameters, `fopen` flags, command
  return codes, etc.)
- Extension install hardening:
  - ZIP path traversal / absolute path / null-byte checks
  - local trusted ZIP only (remote extension download disabled)
  - extension package name validation
- Extension metadata hardening:
  - homepage scheme allow-list (`http` / `https`)
  - author name / email escaping
- `LazyRenderable` compatibility for `Modal` / `Widgets\Form`
- `VersionManager::getNewFileVersions()` off-by-one fix
- `Admin::VERSION` bumped to `2.2.4`

## Local additions

- `#[\AllowDynamicProperties]` on `Dcat\Admin\Support\WebUploader` (PHP 8.2+
  dynamic-property deprecation).

## Not backported

- `.github/workflows/*`
- `README.md`, `CHANGELOG.md`
- Dusk / CI test changes

## Security audit follow-ups (v2.2.5)

The upstream advisories for `/admin/auth/menu` and `/admin/auth/extensions`
(CVE-2024-54775 / GHSA-37x3-j9jq-vrjx) had no official patched release, so the
remaining vectors were fixed here:

- Menu titles are escaped in `resources/views/partials/menu.blade.php`.
- Menu tree payload escapes `title`, `icon` and `uri`
  (`src/Http/Controllers/MenuController.php`).
- Toastr messages are JSON-encoded with `@json()` and the type is allow-listed
  (`resources/views/partials/toastr.blade.php`).
- Markdown textarea content and color preview value are escaped.

Known remaining / accepted surfaces (not changed):

- `partials/alerts.blade.php` and `partials/exception.blade.php` intentionally
  render raw HTML; they are developer-controlled (exception page is debug-only).
- `form/display.blade.php` is a developer-facing "display raw HTML" field.
- Grid column values are escaped by default via `Column::htmlEntityEncode()`.
