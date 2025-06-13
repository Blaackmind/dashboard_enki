<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'delegated_to',
        'permission_level',
        'expires_at',
        'is_active',
        'permissions'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'permissions' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status',
        'permission_label'
    ];

    /**
     * Scope a query to only include active delegations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope a query to only include expired delegations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpired($query)
    {
        return $query->where('is_active', true)
                    ->where('expires_at', '<=', now());
    }

    /**
     * Get the user who delegated the powers.
     */
    public function delegator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user who received the delegated powers.
     */
    public function delegate()
    {
        return $this->belongsTo(User::class, 'delegated_to');
    }

    /**
     * Get the status attribute.
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        if (!$this->is_active) {
            return 'Revogado';
        }

        return $this->expires_at > now() ? 'Ativo' : 'Expirado';
    }

    /**
     * Get the permission level label.
     *
     * @return string
     */
    public function getPermissionLabelAttribute()
    {
        $levels = [
            'read' => 'Somente Leitura',
            'write' => 'Leitura e Escrita',
            'admin' => 'Administrador'
        ];

        return $levels[$this->permission_level] ?? $this->permission_level;
    }

    /**
     * Check if the delegation is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->is_active && $this->expires_at > now();
    }

    /**
     * Revoke this delegation.
     *
     * @return bool
     */
    public function revoke()
    {
        $this->is_active = false;
        return $this->save();
    }

    /**
     * Extend the expiration date.
     *
     * @param  \Carbon\Carbon  $newDate
     * @return bool
     */
    public function extend($newDate)
    {
        if ($newDate > now()) {
            $this->expires_at = $newDate;
            return $this->save();
        }

        return false;
    }
}