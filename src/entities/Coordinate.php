<?php
namespace Entities;

class Coordinate {
    public float $longitude;
    public float $latitude;

    public function getDistanceTo(Coordinate $point, $earthRadius = 6371000): float {
        $latFrom = ($this->latitude);
        $lonFrom = ($this->longitude);
        $latTo = ($point->latitude);
        $lonTo = ($point->longitude);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }
}