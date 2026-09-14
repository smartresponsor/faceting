const { defineConfig } = require('@playwright/test');

module.exports = defineConfig({
  testDir: './tests/UI',
  fullyParallel: false,
  workers: 1,
  use: {
    baseURL: 'http://127.0.0.1:8765',
    channel: 'chrome',
    headless: true,
  },
  webServer: {
    command: 'php -S 127.0.0.1:8765 -t public public/index.php',
    url: 'http://127.0.0.1:8765/facet/management/facets',
    reuseExistingServer: false,
    timeout: 120000,
    env: {
      APP_ENV: 'test',
      APP_DEBUG: '1',
    },
  },
});
