@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ $user->name}}</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">{{ $user->email}}</li>
                    <li class="list-group-item">{{ $user->phone ?? 'no phone' }}</li>
                    <li class="list-group-item"> <img src="{{ asset($user->profile_image) }}" alt="" class="img-fluid"></li>
                </ul>
            </div>
            <div class="card-footer">
                <a class="btn btn-secondary" href="{{url('/home')}}">< Back</a>
                <button class="btn btn-primary" data-toggle="modal" data-target="#updateProfle">Update Profile</button>
            </div>
        </div>
    </div>
    <div class="modal" id="updateProfle" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/home/user/{{$user->id}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">

                @method('PUT')
                @csrf
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" >
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                <label for="profile_image">Select Profile Image</label>
                <input type="file" id="profile_image" accept="image/*" name="profile_image" class="form-control" value="{{ $user->profile_image }}">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>
@endsection
