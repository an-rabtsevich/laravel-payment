<?php

namespace App\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'active_until',
        'user_id',
        'plan_id',
    ];

    protected $dates = [
        'active_until'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function isActive()
    {
        // return true;
        $active_until = new DateTimeImmutable($this->active_until);
        $now = new DateTimeImmutable();
        return $active_until > $now ? true : false;
    }
}
