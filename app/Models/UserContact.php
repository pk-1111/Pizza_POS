<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
     // usercontact

    protected $fillable = ['user_name','phone','address','contact_image','contact_reason'];
}
