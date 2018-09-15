<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('gerenciar-atividades', function ($funcionario) {
            return isset($funcionario->admGeral);
        });
        Gate::define('gerenciar-culturas', function ($funcionario) {
            return isset($funcionario->admGeral);
        });
        Gate::define('gerenciar-funcionarios', function ($funcionario) {
            return isset($funcionario->admGeral);
        });
        Gate::define('gerenciar-itens', function ($funcionario) {
            return isset($funcionario->admGeral);
        });

        Gate::define('gerenciar-movimentacoes', function ($funcionario) {
            return isset($funcionario->admGeral);
        });

        Gate::define('gerenciar-requisicoes', function ($funcionario) {
            return isset($funcionario->admGeral);
        });

        Gate::define('gerenciar-talhoes', function ($funcionario) {
            return isset($funcionario->admGeral);
        });

        Gate::define('gerenciar', function ($funcionario) {
            return isset($funcionario->admGeral);
        });
    }
}
