<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @if (Auth::check() && Auth::user()->role=='admin || user' || Auth::user()->permission == 'editaccess')
        <button type="button" class="btn btn-outline-info clist" data-bs-toggle="modal" data-bs-target="#listcreate">Create List</button>
        @endif
        @if (Auth::check() && Auth::user()->role=='admin')
        <button type="button" class="btn btn-outline-success clist" data-bs-toggle="modal" data-bs-target="#newUser">New User</button>
        @endif


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                @foreach ($lists as $list)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            {{$list->title}}
                        </div>
                        @foreach ($list->Card as $card)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item ">
                                <a class="cardlist" href="list/{{$list->id}}/card/{{$card->id}}">{{$card->title}}</a>
                                @if ($card->status == 1)
                                <i class="fas fa-check-circle"></i>
                                @else
                                <i class="fas fa-times-circle"></i>
                                @endif
                                @if (Auth::Check() && Auth::user()->role == 'admin' || Auth::user()->id == $card->user_id )
                                <form method="POST" action="/delete/card">
                                    @csrf
                                    <input type="hidden" value="{{$card->id}}" name="card_id" />
                                    <button type="submit" class="btn btn-danger btn-sm cardDel">Delete</button>
                                </form>
                                @endif


                            </li>
                        </ul>
                        @endforeach
                        @if (Auth::check() && Auth::user()->role == 'Admin || user' || Auth::user()->permission == 'editaccess')
                        <button type="button" data_value="{{ $list->id }}" class="btn btn-outline-info crtcard" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Create Card
                        </button>
                        @endif

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="listcreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create/list">
                        @csrf
                        <div class="mb-3">
                            <label for="listTitle" class="form-label">Title</label>
                            <input type="text" name="listName" class="form-control" id="listTitle" aria-describedby="List" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('.crtcard').click(function() {
                console.log($(this).attr('data_value'));
                $("#listid").val($(this).attr('data_value'));
            });
        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create/card">
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1">Title</label>
                                    <input type="text" name="cardTitle" id="form3Example1" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label" for="form3Example2">Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" id="listid" name="list_id" value="" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="Submit" class="btn btn-primary">Create Card</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newUser" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/newUser">
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1">Name</label>
                                    <input type="text" name="name" id="form3Example2" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label" for="form3Example1">Email</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label" for="form3Example1">Password</label>
                                <input type="password" name="password" class="form-control" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label" for="form3Example1">Role</label>
                                <select class="form-select" aria-label="Default select example" name="role" required>
                                    <option selected>Open this select menu</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="permission" id="inlineRadio1" value="editaccess">
                                    <label class="form-check-label" for="inlineRadio1">Edit Access</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="permission" id="inlineRadio2" value="onlyview">
                                    <label class="form-check-label" for="inlineRadio2">Only View</label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="Submit" class="btn btn-primary">Create Card</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>
