<?php

namespace Ignite\Core\Entities;

use Ignite\Users\Entities\User;
use Illuminate\Database\Eloquent\Model;


class Notification extends Model {

    protected $guarded = [];
    protected $appends = ['time_ago'];
    public $table = 'core_notifications';

    
    public function user() {
        return $this->belongsTo(User::class);
    }

    
    public function getTimeAgoAttribute() {
        return $this->created_at->diffForHumans();
    }

}
