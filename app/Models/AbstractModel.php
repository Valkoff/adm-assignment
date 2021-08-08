<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

abstract class AbstractModel extends Model
{
    use HasFactory;
    use GeneratesUuid;

    protected $guarded = ['uuid'];

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;
}
