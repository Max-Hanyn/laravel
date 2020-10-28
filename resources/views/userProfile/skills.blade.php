@extends('layouts.app')
@section('header')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link href="{{ asset('css/skill.css') }}" rel="stylesheet">
    <script src="{{ asset('js/skills.js') }}"></script>
@endsection
@section('content')
    <div id="massage">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Profile

                        @can('currentUserProfile',$id)
                            <button type="button" class="add-button btn btn-primary" data-toggle="modal"
                                    data-target="#profileModal">Add new skill
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="profileTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Language</th>
                                @can('currentUserProfile',$id)
                                    <th>Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($user->skills as $skill)
                                <tr id="skill{{$skill->id}}">
                                    <td>{{$skill->name}}</td>
                                    <td>{{$skill->level}}</td>
                                    <td>{{$skill->language}}</td>
                                    @can('currentUserProfile',$id)
                                        <td>
                                            <div>
                                                <button type="button" class="edit btn btn-info" data-toggle="modal"
                                                        value="{{$skill->id}}"><i class="material-icons">&#xE254;</i>
                                                </button>
                                                <button type="button" class="delete btn btn-danger" data-toggle="modal"
                                                        value="{{$skill->id}}"><i class="material-icons">&#xE872;</i>
                                                </button>
                                            </div>
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


    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="profileForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <input type="text" name="level" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="language">Language</label>
                            <input type="text" name="language" class="form-control">
                        </div>

                        <button type="submit" name="submit" class="btn btn-success">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="profileEditForm">
                        @csrf
                        <input id="hiddenId" type="hidden" name="id" class="form-control">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="name1 form-control">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <input type="text" name="level" class="level1 form-control">
                        </div>
                        <div class="form-group">
                            <label for="language">Language</label>
                            <input type="text" name="language" class="language1 form-control">
                        </div>

                        <button type="submit" name="submit" class="btn btn-success">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

