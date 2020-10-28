@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Moderator panel ') }}</div>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>ID</td>
                            {{--                            <td>Name</td>--}}
                            <td>Email</td>
                            <td>Nickname</td>
                            <td>Verified</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nickname }}</td>
                                <td>{{ $user->email_verified_at }}</td>



                                <td>

                                    @if($user->email_verified_at)
                                        <p> Verifed </p>
                                    @else

                                        <form method="POST"  action="moderator/verify">
                                            @csrf
                                            <input name = 'id' type="hidden" value="{{$user->id}}">

                                            <button type="submit" class="btn btn-primary">
                                                Verify this user
                                            </button>

                                        </form>
                                    @endif
                                </td>
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
