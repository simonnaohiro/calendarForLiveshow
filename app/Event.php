<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // 論理削除
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'post_user_id', 'event_date', 'event_title', 'price',
        'contents', 'event_image', 'performers',
        'ended_at',
    ];

    protected $table = 'events';

    public function scopePoster($query, $event_id)
    {
        $query->find($event_id)->get(['post_user_id']);
    }

    public function scopePrice($query, $event_id)
    {
        $query->find($event_id)->get(['price']);
    }
}
