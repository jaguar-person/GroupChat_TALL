<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $dates = ['last_message_at'];
    protected $fillable = ['last_message_at', 'uuid'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('read_at')->withTimestamps();
    }

    public function others()
    {
        return $this->users()->where('user_id', '!=', auth()->id());
    }
}
