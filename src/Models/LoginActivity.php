<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $ip
 * @property string $event
 * @property string $guard
 * @property boolean $remember
 * @property string $created_at
 * @method static Builder login()
 * @method static Builder logout()
 * @method static Builder|LoginActivity whereCreatedAt($value)
 * @method static Builder|LoginActivity whereEvent($value)
 * @method static Builder|LoginActivity whereGuard($value)
 * @method static Builder|LoginActivity whereId($value)
 * @method static Builder|LoginActivity whereIp($value)
 * @method static Builder|LoginActivity whereRemember($value)
 */
class LoginActivity extends Model
{
    /**
     * Removes the "updated_at" column
     */
    public const UPDATED_AT = null;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'login_activities';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];

    public const EVENT_LOGIN  = 'login';
    public const EVENT_LOGOUT = 'logout';

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeLogin(Builder $query): Builder
    {
        return $query->where('event', self::EVENT_LOGIN);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeLogout(Builder $query): Builder
    {
        return $query->where('event', self::EVENT_LOGOUT);
    }
}