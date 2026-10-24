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
