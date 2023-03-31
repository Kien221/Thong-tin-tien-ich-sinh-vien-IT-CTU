<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categorys;

class SearchCategory extends Component
{
    public $search = '';
    public function result()
    {
        $data = Categorys::where('CategoryName', $this->search)->get();
        return view('livewire.search-category',compact('data'));
    }
}
