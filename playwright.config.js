const { defineConfig } = require('@playwright/test');
const path = require('node:path');

const databasePath = path.resolve(__dirname, 'var', 'playwright.db').replaceAll('\\', '/');
const databaseUrl = `sqlite:///${databasePath}`;
const routerPath = path.resolve(__dirname, 'tests', 'UI', 'router.php').replaceAll('\\', '/');

module.exports = defineConfig({
  testDir: './tests/UI',
  fullyParallel: false,
  workers: 1,
  use: {
    baseURL: 'http://127.0.0.1:18080',
    channel: 'chrome',
    headless: true,
  },
  webServer: {
    command: `php bin/console doctrine:schema:update --force --env=test && php bin/console app:faceting:fixtures:load --env=test && php -S 127.0.0.1:18080 "${routerPath}"`,
    url: 'http://127.0.0.1:18080/facet/management/facets',
    reuseExistingServer: false,
    timeout: 120000,
    env: {
      APP_ENV: 'test',
      APP_DEBUG: '1',
      DATABASE_URL: databaseUrl,
    },
  },
});
