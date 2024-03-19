<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $table = 'clubs';
    public $incrementing = true;
    public $timestamps = true;


    protected $fillable = [
        'tim',
        'city'
    ];


    public function match(): HasMany
    {
        return $this->hasMany(Matches::class);
    }

}
