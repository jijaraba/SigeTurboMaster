<?php namespace SigeTurbo\Services;

use Illuminate\Support\Facades\App;
use illuminate\Support\ServiceProvider;
use OpenCloud\Rackspace;


class RackspaceServiceProvider extends ServiceProvider {

    public function register()
    {
        App::bind('Rackspace', function($app){
            $keys = $app["config"]->get('services.rackspace');
            return new Rackspace(Rackspace::US_IDENTITY_ENDPOINT,array(
                'username' => $keys['username'],
                'apiKey'   => $keys['key']
            ));
        });
    }

}