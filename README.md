# LaraTrading

LaraTrading is a Laravel 12 + Inertia.js + Vue 3 dashboard app with Tailwind CSS v4 and shadcn-vue/BoldKit-style UI components.

## Stack

- PHP 8.2+
- Laravel 12
- Inertia.js (Vue 3)
- Vite 7
- Tailwind CSS v4
- TypeScript

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+ and npm
- A database (SQLite/MySQL/PostgreSQL). Default `.env.example` uses SQLite.

## Quick Start

```bash
cd LaraTrading
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

Then open `http://127.0.0.1:8000`.

## Useful Commands

- Dev frontend: `npm run dev`
- Dev full stack (server + queue + vite): `composer run dev`
- Build assets: `npm run build`
- Type check: `npm run types:check`
- Lint JS/TS/Vue: `npm run lint`
- Format frontend files: `npm run format`
- Run tests: `php artisan test`

## UI Components (shadcn-vue / BoldKit)

Add components with:

```bash
npm run ui:add -- @boldkit/<name>
```

or:

```bash
npm run ui:add -- https://boldkit.dev/r/vue/<name>.json
```

Example:

```bash
npm run ui:add -- @boldkit/stat-card
```

## Project Structure

- `app/` Laravel backend code
- `routes/` Laravel routes
- `resources/js/` Vue pages/components/layouts
- `resources/css/app.css` Tailwind entry CSS
- `styles/globals.css` shared theme tokens
- `components.json` shadcn-vue config
- `scripts/add-ui-component.ps1` helper for UI component add/move flow

## Notes

- If `npm run build` fails with a Wayfinder/PHP error, ensure `php` is available in your shell PATH.
- If UI changes look stale, restart Vite and hard refresh browser (`Ctrl+F5`).
