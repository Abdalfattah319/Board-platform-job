<?php

namespace App\Helpers;

class JobHelper
{
    /**
     * Translate job type enum to Arabic
     *
     * @param string $type
     * @return string
     */
    public static function translateJobType($type)
    {
        $types = [
            'full_time' => 'دوام كامل',
            'part_time' => 'دوام جزئي',
            'remote' => 'عن بعد',
            'contract' => 'عقد',
        ];

        return $types[$type] ?? $type;
    }
}
