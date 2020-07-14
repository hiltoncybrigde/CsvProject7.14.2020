<div class="container">
<table class="table table-striped text-center">
<thead>
  <tr>
    <th>Email</th>
    <th>Password</th>
    <th>Address</th>
  </tr>
</thead>
<tbody>
  @foreach ($users as $user)
    <tr>
      <td>{{$user->name ?? 'nan'}}</td>
      <td>{{$user->email ?? 'nan'}}</td>
      <td>{{$user->address ?? 'nan'}}</td>
    </tr>
  @endforeach
</tbody>
</table>
@extends('csv.functions.function')
</div>