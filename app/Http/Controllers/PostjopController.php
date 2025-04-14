<?php

namespace App\Http\Controllers;

use App\Http\Requests\jobPostFormRequest;
use App\Models\Listing;
use App\Post\jobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostjopController extends Controller
{
    protected $jop;
    public function __construct(jobPost $jop)
    {
        $this->jop=$jop;
    }

    public function create(){
        return view('jop.create');
    }

    

    public function store(jobPostFormRequest $request){
        
      $this->jop->store($request);
        return back();
    }

    public function edit(Listing $listing){
        return view('jop.edit',compact('listing'));
    }
}
