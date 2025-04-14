<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable=[
         'user_id',
         'title',
         'description',
         'roles',
         'jop-type',
         'address',
         'salary',
         'application_clos_date',
         'feature image',
         'slug'
  ];
}
