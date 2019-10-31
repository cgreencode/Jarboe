<?php

namespace Yaro\Jarboe\Tests\Http\Controllers;

use Yaro\Jarboe\Http\Middleware\GuardSwitcher;
use Yaro\Jarboe\Tests\AbstractBaseTest;

class GuardSwitcherTest extends AbstractBaseTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../../database/migrations'),
        ]);
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('database.default', 'testing');
        $app['config']->set('auth.guards.admin.driver', 'session');
        $app['config']->set('auth.guards.admin.provider', 'admins');
        $app['config']->set('auth.providers.admins.driver', 'eloquent');
        $app['config']->set('auth.providers.admins.model', \Yaro\Jarboe\Models\Admin::class);
        $app['config']->set('permission.models.permission', \Spatie\Permission\Models\Permission::class);
        $app['config']->set('permission.models.role', \Spatie\Permission\Models\Role::class);
        $app['config']->set('permission.cache.expiration_time', 0);
        $app['config']->set('permission.table_names', [
            'roles' => 'roles',
            'permissions' => 'permissions',
            'model_has_permissions' => 'model_has_permissions',
            'model_has_roles' => 'model_has_roles',
            'role_has_permissions' => 'role_has_permissions',
        ]);
        $app['config']->set('permission.column_names', [
            'model_morph_key' => 'model_id',
        ]);
    }

    /**
     * @test
     */
    public function check()
    {
        $middleware = new GuardSwitcher();

        $this->assertNotEquals(auth()->getDefaultDriver(), admin_user_guard());

        $middleware->handle(
            $this->createRequest(),
            function () {
                return 'hey';
            }
        );
        $this->assertEquals(auth()->getDefaultDriver(), admin_user_guard());
    }
}
