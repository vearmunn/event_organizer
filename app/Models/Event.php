<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

     protected $fillable = [
    'title',
    'description',
    'location',
    'date',
    'organizer_id',
    'image',
    'category_id',
];

public function user()
{
    return $this->belongsTo(User::class, 'organizer_id');
}
public function category()
{
    return $this->belongsTo(Category::class);
}

public function registrations()
{
    return $this->hasMany(Registration::class);
}
}