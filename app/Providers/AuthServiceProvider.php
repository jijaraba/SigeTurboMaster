<?php

namespace SigeTurbo\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use SigeTurbo\Admission;
use SigeTurbo\Communication;
use SigeTurbo\Financial;
use SigeTurbo\Formation;
use SigeTurbo\Parents;
use SigeTurbo\Policies\AdmissionPolicy;
use SigeTurbo\Policies\CommunicationPolicy;
use SigeTurbo\Policies\FinancialPolicy;
use SigeTurbo\Policies\FormationPolicy;
use SigeTurbo\Policies\ParentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Admission::class => AdmissionPolicy::class,
        Financial::class => FinancialPolicy::class,
        Formation::class => FormationPolicy::class,
        Communication::class => CommunicationPolicy::class,
        Parents::class => ParentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
