<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Image;
use App\Models\User;
class Gallery extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'date',
        'cover',
        'drive_url',
        'public',
        'user_id',
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}