@extends('admin.functions.addUser')
@extends('layouts.menu')
@section('contenter')
<div class="container">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="text-center">
      <img  src="{{asset(Session::get('image_status'))}}" class="w-10" alt="">
    </div>
  </div>
</div> 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table>
                  <tr>
                    <td>
                      <div class="card-header">number of users : {{DB::table('users')->get()->count()}}</div>
                    </td>
                    <td>
                    <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalRegisterForm"> New User </button>
                    <div class="row justify-content-center">
                      <div class="col-md-8">
                            <a class="btn btn-info" href="{{ route('admin.export') }}">Export File</a>
                      </div>
                    </div>    
                    </td>
                  </tr>
                </table>
                <table class="table table-striped">

                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Created_at</th>
                      <th scope="col">Email</th>
                      <th scope="col">#</th>
                    </tr>
                  </thead>
                  <tbody class="thistb" id="thistb">
                    @foreach($users as $user)
                    <tr>
                      <td id="display{{$user->id}}">{{$user->name}}</td>
                      <td>{{$user->created_at}}</td>
                      <td>{{$user->email}}</td>
                      <td class="text-center">
                          <button type="button" class='btn btn-info btn-xs' data-toggle="modal" data-target=".myModaluser{{$user->id}}"><span class="glyphicon glyphicon-edit"></span>edit</button>
                        @if(Auth::user()->id != $user->id)
                          <button class="btn btn-danger btn-xs" onClick="$(this).closest('tr').fadeOut(800,function(){$(this).remove();});" type="button" ><span class="glyphicon glyphicon-remove"></span><a href="/admin/delete/{{$user->id}}"> Del</a></button>
                        @endif
                    </td>
                      <div id="myModaluser{{$user->id}}" class="modal fade myModaluser{{$user->id}}" role="dialog">
                        <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Edit user's profile</h4>
                            </div>
                            <div class="modal-body">
                              <div>



                                <form action="{{ route('admin.updateuser') }}" method="post" class="my_topic_change_form{{$user->id}}" id="my_topic_change_form{{$user->id}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="form-group">
                                  <label for="exampleInputEmail1">Remane your name</label>
                                  <input type="text" class="form-control" name="name" aria-describedby="noticeHelp" value="{{$user->name}}" placeholder="{{$user->name}}"> 
                                  <label for="exampleInputEmail1">Your address?</label>
                                  <input type="text" class="form-control" name="address" aria-describedby="noticeHelp" placeholder="{{$user->address??'yours address?'}}"> 
                                  <label for="exampleInputEmail1">Remane email name</label>
                                  <input type="email" class="form-control" name="email" aria-describedby="noticeHelp" value="{{ $user->email}}" placeholder="{{$user->email}}" readonly>
                                  
                                  <label for="exampleInputEmail1">Avatar</label>
                                  <input type="file" class="form-control" name="file" aria-describedby="noticeHelp" value="{{$user->name}}" placeholder="{{$user->name}}"> 

                                  <input type="hidden" name="id" value="{{ $user->id}}">

                                  <button type="submit" class="btn btn-primary">Change</button> 
                                </form>
                              </div>
                           
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

{{ $users->links() }}
@endsection