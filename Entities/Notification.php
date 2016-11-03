<?php

namespace Ignite\Core\Entities;

use Ignite\Users\Entities\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Core\Entities\Notification
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $group
 * @property string $type
 * @property string $icon_class
 * @property string $link
 * @property string $title
 * @property string $message
 * @property boolean $is_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Ignite\Users\Entities\User $user
 * @property-read mixed $time_ago
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereIconClass($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereIsRead($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notification extends Model {

    protected $guarded = [];
    protected $appends = ['time_ago'];
    public $table = 'core_notifications';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the created time in difference for humans (2 min ago)
     * @return string
     */
    public function getTimeAgoAttribute() {
        return $this->created_at->diffForHumans();
    }

}
