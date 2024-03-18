<?php

namespace App\Services;

use App\Models\Property;
use Carbon\Carbon;

class PropertyService
{
    public function getAllProperties()
    {
        return Property::with('location')->paginate(10);
    }

    public function searchProperties($searchParams)
    {
        $propertiesQuery = Property::query();
        $propertiesQuery->where(function ($query) use ($searchParams) {
            $searchQuery = $searchParams['query'] ?? '';
            $query->where('property_name', 'like', "%$searchQuery%")
                ->orWhereHas('location', function ($locationQuery) use ($searchQuery) {
                    $locationQuery->where('location_name', 'like', "%$searchQuery%");
                });
        });

        if (isset($searchParams['pets_allowed'])) {
            $propertiesQuery->where('accepts_pets', true);
        }

        if (isset($searchParams['near_beach'])) {
            $propertiesQuery->where('near_beach', true);
        }

        if (isset($searchParams['min_beds'])) {
            $propertiesQuery->where('beds', '>=', $searchParams['min_beds']);
        }

        if (isset($searchParams['min_sleeps'])) {
            $propertiesQuery->where('sleeps', '>=', $searchParams['min_sleeps']);
        }

        if (isset($searchParams['currently_available'])) {
            $currentDate = Carbon::now();
            $propertiesQuery->whereDoesntHave('bookings', function ($bookingQuery) use ($currentDate) {
                $bookingQuery->where('end_date', '>=', $currentDate)
                    ->where('start_date', '<=', $currentDate);
            });
        }

        return $propertiesQuery->paginate(10);
    }


    public function getMaxBeds()
    {
        return Property::max('beds');
    }

    public function getMaxSleeps()
    {
        return Property::max('sleeps');
    }

    public function updateAvailability($properties, $currentDate)
    {
        foreach ($properties as $property) {
            $bookings = $property->bookings()->where('end_date', '>=', $currentDate)
                ->where('start_date', '<=', $currentDate)
                ->exists();
            $property->availability = $bookings ? 'Unavailable' : 'Available';
        }

        return $properties;
    }
}
