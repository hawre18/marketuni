<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nagy\LaravelRating\Traits\Rate\Rateable;

class Product extends Model
{
    use Rateable;
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class,'attributevalue_product','product_id','attributeValue_id');
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class,'photo_product','product_id','photo_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
