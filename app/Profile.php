<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Profile extends Model
{
    use SoftDeletes;

    protected $fillable = [ 'age', 'gender', 'address', 'user_id', 'date'];

    // protected $casts = [ 
    //     'gender' => 'boolean',
    //     'date' => 'datetime'
    // ];

    public function getGenderNameAttribute()
    {
        if ($this->gender == 0){
            return 'Male';
        }
        return 'Female';
        // return  $this->gender == 0 ? 'Male' : 'Female';
    }

    public function getIsAdultAttribute()
    {
        return $this->age > 18 ? true : false;
    }

    public function setAgeAttribute($value)
    {
        $this->attributes['age'] = $value > 0 ? $value : 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class ); // user_id  , userID
    }
}
