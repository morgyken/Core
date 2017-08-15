<?php

namespace Ignite\Core\Entities;

use Ignite\Users\Entities\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Core\Entities\Notification
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $type
 * @property string $icon_class
 * @property string|null $link
 * @property string $title
 * @property string $message
 * @property int $is_read
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $time_ago
 * @property-read \Ignite\Users\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereIconClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ignite\Core\Entities\Notification whereUserId($value)
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
