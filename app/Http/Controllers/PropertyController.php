<?php

namespace App\Http\Controllers;

use App\Services\PropertyService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PropertyController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function index(Request $request)
    {
        $properties = $this->propertyService->getAllProperties();
        $maxBeds = $this->propertyService->getMaxBeds();
        $maxSleeps = $this->propertyService->getMaxSleeps();
        $currentDate = Carbon::now();
        $properties = $this->propertyService->updateAvailability($properties, $currentDate);

        // dd($properties)

        return view('bookingPage', compact('properties', 'maxBeds', 'maxSleeps'));
    }

    public function search(Request $request)
    {
        $searchParams = $request->only(['query', 'pets_allowed', 'near_beach', 'currently_available', 'min_beds', 'min_sleeps']);
        $properties = $this->propertyService->searchProperties($searchParams);
        $maxBeds = $this->propertyService->getMaxBeds();
        $maxSleeps = $this->propertyService->getMaxSleeps();
        $currentDate = Carbon::now();
        $properties = $this->propertyService->updateAvailability($properties, $currentDate);

        // dd($properties)

        return view('bookingPage', compact('properties', 'maxBeds', 'maxSleeps'));
    }
}
