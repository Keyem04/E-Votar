<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

    use LogsActivity;
    protected $table = 'positions';
    protected $fillable = ['election_type_id', 'name', 'num_winners'];

    public function elections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Election::class, 'election_positions');
    }

    public function electionType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(election_type::class, 'election_type_id');
    }

    public function electionPositions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ElectionPosition::class, 'position_id');
    }

    public function candidates(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Candidate::class, ElectionPosition::class, 'position_id', 'election_position_id');
    }

    public function abstains(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AbstainVote::class, 'position_id');
    }


}
