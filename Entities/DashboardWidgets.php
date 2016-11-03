<?php

namespace Ignite\Core\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Ignite\Core\Entities\DashboardWidgets
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $widgets
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\DashboardWidgets whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\DashboardWidgets whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\DashboardWidgets whereWidgets($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\DashboardWidgets whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ignite\Core\Entities\DashboardWidgets whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DashboardWidgets extends Model {

    protected $fillable = [];
    public $table = 'core_dashboard_widgets';

}
