<?php

namespace SigeTurbo\Repositories\Provider;

use SigeTurbo\Provider;

class ProviderRepository implements ProviderRepositoryInterface
{

    /**
     * Return all values
     * @param null $search
     * @param null $sort
     * @param string $order
     * @return mixed
     */
    public function all($search = null, $sort = null, $order = 'ASC')
    {
        $providers = Provider::select('providers.*');

        //Search
        if ($search !== null) {
            $keys = explode(':', $search);
            if (count($keys > 1)) {
                switch ($keys[0]) {
                    case 'firstname':
                        $providers
                            ->where('providers.name', 'LIKE', "%$keys[1]%");
                        break;
                    default:
                }
            }
        }

        //Sort
        switch($sort){
            case 'name':
                $providers->orderBy('providers.name', $order);
                break;
            case 'date':
                $providers->orderBy('providers.date', $order);
                break;
            case 'created_at':
                $providers->orderBy('providers.created_at', $order);
                break;
            default:
                $providers->orderBy('providers.name', $order);
        }
        return $providers
            ->with('evaluations')
            ->get();
    }

    /**
     * Find in Databases
     * @param $idprovider
     * @return mixed
     */
    public function find($idprovider)
    {
        return Provider::select('*')
            ->where('idprovider','=',$idprovider)
            ->with('purchases')
            ->first();
    }


    public function store($data)
    {
        // TODO: Implement store() method.
    }

    /**
     * Update Provider
     * @param $idprovider
     * @param $data
     * @return mixed
     */
    public function update($idprovider, $data)
    {
        //Find provider
        $provider = Provider::find($idprovider);
        $provider->fill(array(
            'nit' => $data['nit'],
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'fax' => $data['fax'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'web' => $data['web'],
            'observation' => $data['observation'],
            'services' => $data['services'],
            'leadtime' => $data['leadtime'],
            'paymentform' => $data['paymentform'],
            'warranty' => $data['warranty'],
            'evaluation' => $data['evaluation'],
            'date' => $data['date'],
        ));
        return $provider->save();
    }

    public function destroy($idprovider)
    {
        // TODO: Implement destroy() method.
    }
}
