<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Cache;
use Carbon\Carbon;
use Auth;
class UserController extends Controller
{

	protected $userRepository;

	/**
	 * [__construct description]
	 * @param UserRepository $userRepository [description]
	 */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }


    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
    	$users = User::orderBy('id', 'desc')->paginate(10);

    	return view('admin.manager')->with('users',$users);
    }


    /**
     * [userfun description]
     * @param  UserRequest $request [description]
     * @return [type]               [description]
     */
    public function userfun(UserRequest $request)
    {
        $admin = auth()->user();
        $data  = $request->all();

        $data?$this->eventByModelAfterCreateRequest($data)
            :$this->returnWithError($data);

        return redirect()->back();
    }


    /**
     * [delete description]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function delete($user)
    {
        $user = User::findOrFail($user);
        $user->delete();
        return redirect()->back();
    }




    /**
     * [update description]
     * @param  ImageRequest $request [description]
     * @return [type]                [description]
     */
    public function updatewithimage(ImageRequest $request)
    {   
        $time = Carbon::now()->format('dhi');

        $data = $request->all();

        if($data && $request->hasFile('file'))
        {

            $image     = $data['file'];
            $extension = $image->getClientOriginalExtension();
            $name      = $time.'-'.basename($image).'.'.$extension;
            $path      = Storage::putFileAs('public/uploads',$image,$image->hashName());
            $na        = $image->hashName();
            $user      = User::findOrFail($data['id']);

            User::where('id', $user->id)->update([
                'name'   =>  $data['name'],
                'address'   =>  $data['address'],
                'photo1' =>  asset('storage/uploads/'.$na),
                'photo2' =>  base64_encode(asset('storage/uploads/'.$na)),
            ]);

            $path?Session::flash('image_status','storage/uploads/'.$na):Session::flash('image_status', 'image uploaded fail!!');
            return redirect()->back();

        }else if(!$request->hasFile('file') && $data) {

            $user = User::findOrFail($data['id']);

            User::where('id', $user->id)->update([
                'name' => $data['name'],
                'address'   =>  $data['address'],
            ]);
            
            return redirect()->back();
        }
        else{  
            \Log::error('cannot update');
            return $this->returnWithError($data);
        }

    }

    //DB::table('users')->where('name','like','E%')->get();
    public function sortpage($num = null)
    {
       if($num != NULL || $num != ''){ 
       $users = $this->sortWithFirstLetter($num);
       Session::put('usersexport', $users);
        }
        else{
       $users = User::orderBy('name')->paginate(10);
        }
       return view('csv.CsvGenerate')->with('users',$users);


    }    

    /////////////////////////config/////////////////////////////////////////
    public function returnWithError($data)
    {
        \Log::error("cannoot add this user ".$user_this);
        return redirect()
                    ->back()
                    ->withErrors($data)
                    ->withInput();
    }

    public function eventByModelAfterCreateRequest($data)
    {
        $user_id = $this->userRepository->createAndGetID($data);
            $user_this = User::find($user_id);
            \Log::info("user has been added ".$user_this);
    }
    public function sortWithFirstLetter($num)
    {
        return $users = DB::table('users')->where('name','like', $num.'%')->get();
    }
 	/////////////////////////config/////////////////////////////////////////
}
