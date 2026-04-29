<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', 1);
    }

    public static function getUnreadCount()
    {
        return self::unread()->count();
    }

    public function markAsRead()
    {
        $this->update(['is_read' => 1]);
    }

    public function markAsUnread()
    {
        $this->update(['is_read' => 0]);
    }
}