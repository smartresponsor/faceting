const { test, expect } = require('@playwright/test');

test('filters facet management results in a real browser', async ({ page }) => {
  await page.goto('/facet/management/facets');

  await expect(page.getByRole('heading', { name: 'Faceting management' })).toBeVisible();
  await page.locator('#type').selectOption('range');
  await page.getByRole('button', { name: 'Apply filters' }).click();

  await expect(page.locator('[data-testid="facet-total"]')).toHaveText('1');
  await expect(page.getByRole('table')).toContainText('price');
  await expect(page.getByRole('table')).not.toContainText('brand');
});

test('previews a normalized facet through the management form', async ({ page }) => {
  await page.goto('/facet/management/facets');

  await page.locator('#facet_upsert_code').fill('Campaign_Code');
  await page.locator('#facet_upsert_nameEntity').fill('Campaign Facet');
  await page.locator('#facet_upsert_type').selectOption('term');

  const visible = page.locator('#facet_upsert_visible');
  if (!(await visible.isChecked())) {
    await visible.check();
  }

  await page.getByRole('button', { name: 'Generate preview' }).click();

  await expect(page.getByRole('status')).toContainText('Facet preview generated.');
  await expect(page.locator('[data-testid="facet-preview-code"]')).toHaveText('campaign_code');
});
