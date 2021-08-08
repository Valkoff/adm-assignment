<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $uuid
 * @property string $remote_uid
 * @property string $name
 * @property int    $height
 * @property int    $mass
 * @property string $hair_color
 * @property string $skin_color
 * @property string $eye_color
 * @property string $birth_year
 * @property string $gender
 * @property string $planet_uuid
 * @property string $description
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 */
class Person extends AbstractModel
{

    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class, 'planet_uuid', 'uuid');
    }

}
