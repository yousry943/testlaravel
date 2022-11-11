<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\ZipFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class uploadZipController extends Controller
{
    //Create page that upload zip file and extract files in specific folder
    public function uploadZip()
    {
        return view('frontend.uploadZip');
    }

    //show all zip files that uploaded
    public function getAllZip()
    {
        $zipFiles = ZipFile::all();
        return view('frontend.allZip', compact('zipFiles'));
    }



    //get the zip file and extract it based on user id

    public function getZipUser()
    {

        $getZip = User::where('id', auth()->user()->id)->with('Files')->get();
           return $getZip = json_decode($getZip, true);


    }

    //Upload zip file and extract files in specific folder

    public function uploadZipFile(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip'
        ]);

        $zip = new \ZipArchive;
        $zip->open($request->zip_file);
        $zip->extractTo(public_path('uploads'));
        $zip->close();
        // store zip name and path in database
        $zip_file = new ZipFile;
        $zip_file->user_id = auth()->user()->id;
        $zip_file->zip_name = $request->zip_file->getClientOriginalName();

        $zip_file->zip_path = public_path('uploads');
        $zip_file->Sizes = $request->zip_file->getSize();

        $zip_file->save();

       return $this->getZipUser();


        return back()->with('success', 'Zip file uploaded successfully');

    }

    //Delete zip file and folder

    public function deleteZip($id)
    {
        $zip = ZipFile::find($id);
        $zip->delete();
        $path = public_path('uploads');
        $files = glob($path . '/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
        return back()->with('success', 'Zip file deleted successfully');
    }


}
