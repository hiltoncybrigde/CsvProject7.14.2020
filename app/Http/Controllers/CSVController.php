<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\User;
use DB;

class CSVController extends Controller
{
	public function export() 
    {
       $users = Session::get('usersexport');
       // $user = User::find(1);


        return Excel::download(new ExportUsers($users), 'users_list.xls');
    }
}
