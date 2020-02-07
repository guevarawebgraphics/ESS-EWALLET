<?php

namespace App\Repositories\ServiceRates;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\ServiceRates\ServiceRates;

//use Your Model

/**
 * Class ServiceRatesRepository.
 */
class ServiceRatesRepository
{
    /**
     * Get All Service Rates
     **/
    public function showAllServiceRates()
    {
        $serviceRates = ServiceRates::select('id', 'title', 'desc','created_at','updated_at')
            ->latest()
        	->paginate(10);
        return $serviceRates;
    }

    /**
     * Store Service Rates
     **/
    public function storeServiceRates($dataServiceRates)
    {
        $serviceRates = ServiceRates::create([
            'title' => $dataServiceRates->title,
            'desc' => $dataServiceRates->desc,
        ]);
        return $serviceRates;
    }


    /**
     * Update Service Rates
     **/
    public function updateServiceRates($dataServiceRates)
    {
        $serviceRates = ServiceRates::where('id', $dataServiceRates->id)
        ->update([
            'title' => $dataServiceRates->title,
            'desc' => $dataServiceRates->desc,
        ]);
        return $serviceRates;
    }
}
