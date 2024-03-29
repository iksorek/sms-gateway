<?php

namespace App\Models;

use App\Jobs\ProcessSms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SmsController;

class Sms extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $attributes = [
        'status' => 'In queue',
    ];

    public function User(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($Sms) {
            if (env('SEND')) {
                ProcessSms::dispatch($Sms);
            }

        });
    }

}
