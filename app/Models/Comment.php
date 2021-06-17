<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//protected $table = "comments";
//protected $fillable = ["contents"];
//protected $primaryKey = "id";

class Comment extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class)->belongsTo(Test::class);
    }
    public static function store(){
        //return response()->json(['success' => 'Contact form submitted successfully']);
    }

}
