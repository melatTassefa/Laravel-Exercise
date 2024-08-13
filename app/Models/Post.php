<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body'];   //only the body field can be mass assigned

    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);    //check if the post is liked by the user the $this->likes is a collection of likes, return true if the user_id is in the collection
    }
    // public function ownedBy(User $user){         // edited out because we added a policy
    //     return $user->id === $this->user_id;
    // }
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relationship between post and likes, a post can have many likes
    public function likes(){
        return $this->hasMany(Like::class);
    }
}
