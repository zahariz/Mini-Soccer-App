<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matches extends Model
{
    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $table = 'matches';

    public $incrementing = true;
    public $timestamps = true;


    protected $fillable = [
        'tim1',
        'tim2',
        'goal1',
        'goal2'
    ];

    public function homeClub(): BelongsTo
    {
        return $this->belongsTo(Club::class, "tim1");
    }
    public function awayClub(): BelongsTo
    {
        return $this->belongsTo(Club::class, "tim2");
    }

}
