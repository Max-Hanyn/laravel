@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash-message')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admin panel ') }}</div>
                    <div class="container">

                        <nav class="navbar navbar-inverse">
                            <div class="navbar-header">
                            </div>
                            <ul class="nav navbar-nav">
                                <li><a href="{{ URL::to('users') }}">View All users</a></li>

                            </ul>
                        </nav>
                        <form method="POST"  action="{{URL::to("admin/user/$user->id/edit")}}">
                            @csrf
                            @method('PATCH')
                        <table class="table table-striped table-bordered">




                            <tr>
                                <td>User id</td>
                                <td>  {{$user->id}} </td>
                            </tr>
                            <tr>
                                <td>User name</td>
                                <td> <input type="text" name="name" value="{{$user->name}} ">  </td>
                            </tr>
                            <tr>
                                <td>User nickname</td>
                                <td>  <input type="text" name="nickname" value="{{$user->nickname}} "> </td>
                            </tr>
                            <tr>
                                <td>User email</td>
                                <td> <input type="text" name="email" value="{{$user->email}} "> </td>
                            </tr>


                        </table>
                            <button type="submit" class="btn-primary btn">Save</button>
                        </form>
                        <div>

                            @if($user->email_verified_at)
                                Verefied

                            @else
                                <form method="POST"  action="{{route('user.verify')}}">
                                    @csrf
                                    <input name = 'id' type="hidden" value="{{$user->id}}">

                                    <button type="submit" class="btn btn-primary">
                                        Verify this user
                                    </button>

                                </form>
                            @endif
                        </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>


    </div>
@endsection
