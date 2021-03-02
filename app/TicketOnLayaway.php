<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketOnLayaway extends Model
{
    protected $table = 'ticket_on_layaways';

    protected $fillable = [
        'event_id', 'user_id', 'performer_name',
    ];

    public function scopeEvent($query, $event_id)
    {
        $query->where('event_id',  $event_id);
    }

    public function scopePerformer($query, $performer)
    {
        $query->where('performer_name',  $performer);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
