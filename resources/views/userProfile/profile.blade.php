@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash-message')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <img src="" class="avatar img-circle img-thumbnail" alt="avatar">

                                <form id="photoAddForm" method="post" action="/profile/image/add" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="image">
                                    <button type="submit" name="submin">Upload</button>
                                </form>
                            </div>
                        </div>
                      <div>
                          <table class="table table-striped table-bordered">

                                  <tr>
                                      <td>User name</td>
                                      <td> {{$user->name}} </td>
                                  </tr>
                                  <tr>
                                      <td>User nickname</td>
                                      <td> {{$user->nickname}}
                                  </tr>
                                  <tr>
                                      <td>User email</td>
                                      <td> {{$user->email}}
                                  </tr>
                                  <tr>
                                      <td>Is verified</td>
                                      <td>
                                          @if($user->email_verified_at)
                                              Verified
                                          @else
                                              Not verified
                                          @endif</td>
                                  </tr>
                                  <tr>
                                      <td>User created at</td>
                                      <td>{{$user->created_at}}  </td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                      <td>

                                          <!-- Button trigger modal -->
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                              Edit profile
                                          </button>

                                          <!-- Modal -->
                                          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <form method="post" action="{{route('user.edit')}}">
                                                      @csrf
                                                      @method('PATCH')
                                                      <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">


                                                              <table class=" table-bordered">
                                                                  <tr>
                                                                      <td>
                                                                          <label for="email">Email</label>
                                                              <input name="email" type="email" id="email" value="{{$user->email}}">
                                                                          @error('email')
                                                                          <div class="alert alert-danger">{{ $message }}</div>
                                                                          @enderror
                                                                      </td>
                                                                  </tr>
                                                                  <tr><td>
                                                                          <label for="Nickname">Nickname</label>
                                                              <input name="nickname" type="text" id="Nickname" value="{{$user->nickname}}">
                                                                      </td>  </tr>
                                                                  <tr><td>
                                                                          <label for="Name">Name</label>
                                                              <input name="name" type="text" id="Name" value="{{$user->name}}">
                                                                      </td>    </tr>
                                                              </table>


                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                                      </div>
                                                  </div>
                                                  </form>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>



                          </table>


                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
