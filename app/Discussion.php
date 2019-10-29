<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [
        'title', 'content', 'channel_id', 'slug', 'reply_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function getBestReply()
    {
        return Reply::find($this->reply_id);
    }


    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }


    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id
        ]);
    }
}
