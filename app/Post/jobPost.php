<?php  

namespace App\Post;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class jobPost {

    protected $listing;
    public function __construct(Listing $listing)
    {
        $this->listing=$listing;
    }

    public function store($data):void
    {

        $featureImage=$data->file('feature_image');
        $imagePath=$featureImage->store('images','public');
        $this->listing->feature_image=$imagePath;
        $this->listing->user_id=auth()->user()->id;
        $this->listing->title=$data['title'];
        $this->listing->description=$data['description'];
        $this->listing->roles=$data['roles'];
        $this->listing->jop_type = $data['job_type'];
        $this->listing->address=$data['address'];
        $this->listing->application_clos_date=\Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        $this->listing->salary=$data['salary'];
        $this->listing->slug=Str::slug($data['title']).'.'.Str::uuid(); 
        $this->listing->save();
    }
}

