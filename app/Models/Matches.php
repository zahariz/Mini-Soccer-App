<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matches extends Model
{
    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $table = 'clubs';

    public $incrementing = true;
    public $timestamps = true;


    protected $fillable = [
        'tim1',
        'tim2',
        'goal1',
        'goal2'
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}
