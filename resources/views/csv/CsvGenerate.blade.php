<div class="container">
<table class="table table-striped text-center">
<thead>
<tr>
<th>Email</th>
<th>Password</th>
<th>Address</th>
</thead>
<tbody>
 
        @foreach ($users as $user)
<tr>
<td>{{$user->name}}</td>
<td>{{$user->email}}</td>
<td>{{$user->address}}</td>
</tr>
        @endforeach
 
</tbody>
</table>
@extends('csv.functions.function')
</div>