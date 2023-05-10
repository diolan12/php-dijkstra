<?php


if (!function_exists('calcDist')) {
    /**
     * Calculate the distance between two points given their latitude and longitude coordinates.
     *
     * @param float $lat1 The latitude of the first point.
     * @param float $lon1 The longitude of the first point.
     * @param float $lat2 The latitude of the second point.
     * @param float $lon2 The longitude of the second point.
     * @param string $unit The desired distance unit (e.g., "km" for kilometers, "mi" for miles).
     * @return float The distance between the two points in the specified unit.
     */
    function calcDist($lat1, $lon1, $lat2, $lon2, $unit = 'km')
    {
        $earthRadiusKm = 6371; // Radius of the Earth in kilometers
        $earthRadiusMi = 3959; // Radius of the Earth in miles

        $latDiff = deg2rad($lat2 - $lat1);
        $lonDiff = deg2rad($lon2 - $lon1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDiff / 2) * sin($lonDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = 0;

        if ($unit === 'km') {
            $distance = $earthRadiusKm * $c;
        } elseif ($unit === 'mi') {
            $distance = $earthRadiusMi * $c;
        }

        return $distance;
    }
}