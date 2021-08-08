<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $table = 'songs';

    protected $fillable = [
        'name',
        'cate_id',
        'artist_id',
        'link',
        'image'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function lyrics()
    {
        return $this->hasOne(Lyric::class, 'song_id', 'id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_song', 'song_id', 'album_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'song_id', 'id');
    }

    public function playLists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_song', 'song_id', 'playlist_id');
    }

    public function scopeOfCategory($query, $id)
    {
        return $query->where('cate_id', $id);
    }

    public function scopeSongHot($query)
    {
        return $query->where('hot', 1);
    }

    public function scopeOrderById($query)
    {
        return $query->orderBy('id');
    }

    public function scopeSearchName($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }
}
