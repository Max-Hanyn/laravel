@extends('layouts.app')
@section('header')
    <link rel="stylesheet" href="{{ asset('css/usersList.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/usersList.js') }}"></script>
@endsection
@section('content')
    <script>
        window.config = window.config || {
            'addRoute' : '{{route('add.role')}}',
            'deleteRoute' : '{{route('delete.role')}}',
            'csrf' : '{{ csrf_token() }}',
            'isAdmin' :'{{$isAdmin}}',
            'isModerator' :'{{$isModerator}}',
        }
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Users list ') }}

                        <div class="search">
                            <label for="search">Search</label>
                            <input type="text"  id="search">
                        </div>

                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>

                          @can('isModerator')
                                <td>ID</td>
                            @endcan

                            <td>Name</td>
                              @can('isModerator')
                                  <td>Email</td>
                              @endcan
                            <td>Nickname</td>
                            <td>Joined at</td>
                            <td>Roles</td>
                            <td>Skills</td>


                              @can('isModerator')
                                  <td>Actions</td>
                              @endcan

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)

                            <tr class="column-row">
                                @can('isModerator')
                                <td>{{ $user->id }}</td>
                                @endcan


                                <td>{{ $user->name }}</td>

                                    @can('isModerator')
                                        <td>{{ $user->email }}</td>
                                    @endcan

                                <td>{{ $user->nickname }}</td>

                                <td>{{ substr($user->created_at,0,10) }}</td>
                                <td>

                                    <div class="roles-container">
                                        @foreach($user->roles as $role)
                                            <div>

                                                {{$role->name}}
                                                @can('isAdmin')
                                                    <form method="post" action="{{route('delete.role')}}"
                                                          style="display: inline-block">
                                                        @csrf
                                                        <input type="hidden" name="roleId" value="{{$role->id}}">
                                                        <input type="hidden" name="userId" value="{{$user->id}}">
                                                        <button
                                                            style="outline: none;border: 0;background: transparent;width: 5px;height: 5px"
                                                            type="submit">
                                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                                 class="bi bi-x" fill="currentColor"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                      d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </button>
                                                    </form>

                                                @endcan
                                            </div>

                                        @endforeach
                                    </div>
                                    @can('isAdmin')


                                        <form action="{{route('add.role')}}" method="post">
                                            @csrf
                                            <p><select size="3" multiple name="roles[]">
                                                    <option disabled>Roles</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->name}}


                                                            @endforeach
                                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                                </select></p>
                                            <p><input type="submit" value="Add role"></p>
                                        </form>
                                    @endcan

                                </td>
                                    <td>
                                        <a class="btn btn-small btn-info"
                                           href="{{ URL::to('/profile/'.$user->id. '/skills') }}">User skills</a>
                                    </td>
                                @can('isModerator')
                                    <td>
                                        <a class="btn btn-small btn-info"
                                           href="{{ URL::to('admin/user/' . $user->id .'') }}">Edit this user</a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                          </div>


                    </div>
                </div>
            </div>


    </div>
@endsection
