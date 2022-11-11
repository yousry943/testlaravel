<?php

namespace App\Http\Livewire;

use App\Models\ZipFile;
use Livewire\Component;
use Livewire\WithPagination;
class ZipIndex extends Component
{
    use WithPagination;
    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $ZipFiles = ZipFile::where('zip_name', 'like', $searchTerm)->orderBy('id', 'desc')->paginate();


        return view('livewire.zip-index',compact('ZipFiles'));
    }
}
