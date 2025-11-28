<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Get contact info by key
     */
    public static function getValue(string $key, string $default = ''): string
    {
        $info = self::where('key', $key)->first();
        return $info ? $info->value : $default;
    }
}
