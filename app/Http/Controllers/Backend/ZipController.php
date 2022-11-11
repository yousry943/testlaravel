<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\ZipFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
class ZipController extends Controller
{




    public function __construct()
    {
        // Page Title
        $this->module_title = 'Zip';

        // module name
        $this->module_name = 'ZipFile';

        // directory path of the module
        $this->module_path = 'zip';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\ZipFile";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function uploadZip($id)
    {
        return view('backend.zip.uploadZip', compact('id'));
    }


    public function index()
    {


        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = ucfirst($module_title);
        $title = $page_heading.' '.ucfirst($module_action);

        $$module_name = $module_model::paginate();

        Log::info("'$title' viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.$module_path.index",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'page_heading', 'title')
        );
    }

    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::select('id', 'name', 'username', 'email', 'email_verified_at', 'updated_at', 'status');

        $data = $$module_name;

        return Datatables::of($$module_name)
                        ->addColumn('action', function ($data) {
                            $module_name = $this->module_name;

                            return view('backend.includes.user_actions', compact('module_name', 'data'));
                        })
                        ->addColumn('user_roles', function ($data) {
                            $module_name = $this->module_name;

                            return view('backend.includes.user_roles', compact('module_name', 'data'));
                        })
                        ->editColumn('name', '<strong>{{$name}}</strong>')
                        ->editColumn('status', function ($data) {
                            $return_data = $data->status_label;
                            $return_data .= '<br>'.$data->confirmed_label;

                            return $return_data;
                        })
                        ->editColumn('updated_at', function ($data) {
                            $module_name = $this->module_name;

                            $diff = Carbon::now()->diffInHours($data->updated_at);

                            if ($diff < 25) {
                                return $data->updated_at->diffForHumans();
                            } else {
                                return $data->updated_at->isoFormat('LLLL');
                            }
                        })
                        ->rawColumns(['name', 'action', 'status', 'user_roles'])
                        ->orderColumns(['id'], '-:column $1')
                        ->make(true);
    }

    /**
     * Select Options for Select 2 Request/ Response.
     *
     * @return Response
     */
    public function index_list(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading.' '.label_case($module_action);

        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $query_data = $module_model::where('name', 'LIKE', "%$term%")->orWhere('email', 'LIKE', "%$term%")->limit(10)->get();

        $$module_name = [];

        foreach ($query_data as $row) {
            $$module_name[] = [
                'id'   => $row->id,
                'text' => $row->name.' (Email: '.$row->email.')',
            ];
        }

        return response()->json($$module_name);
    }
    //Create page that upload zip file and extract files in specific folder





    //get the zip file and extract it based on user id

    public function getZipUser($id)
    {

        $zipFiles = ZipFile::where('user_id',$id)->get();

        return view('backend.zip.index', compact('zipFiles'));




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
       //update the database with the zip file name where id = $request->id
        $zipFile = ZipFile::find($request->id);
        $zipFile->zip_name = $request->zip_file->getClientOriginalName();
        $zipFile->Sizes = $request->zip_file->getSize();


        $zipFile->save();




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
