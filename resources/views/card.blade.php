<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="/update/card" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-4">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Title</label>
                            @if (Auth::user()->permission == 'onlyview')
                            <input type="text" name="cardTitle" id="form3Example1" value="{{$card->title}}" class="form-control" disabled />
                            @else
                            <input type="text" name="cardTitle" id="form3Example1" value="{{$card->title}}" class="form-control" />

                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label" for="form3Example1">Description</label>
                        @if (Auth::user()->permission == 'onlyview')
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" disabled>{{$card->description}}</textarea>
                        @else
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$card->description}} </textarea>
                        @endif

                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        @if (Auth::user()->permission != 'onlyview')
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <input type="file" class="custom-file-input" id="customFile" name="filename">
                        @endif

                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        @if (Auth::user()->permission == 'onlyview')
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                        <label class="form-check-label" for="flexCheckDefault">
                            complete
                        </label>
                        @else
                        @if ($card->status == 1)
                        <input class="form-check-input" type="checkbox" value="{{$card->status}}" name="checkbox" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                            complete
                        </label>
                        @else
                        <input class="form-check-input" type="checkbox" value="{{$card->status}}" name="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            complete
                        </label>
                        @endif

                        @endif

                    </div>
                </div>
                @if (Auth::check() && Auth::user()->role == 'Admin' || Auth::user()->permission == 'editaccess')
                <div class="modal-footer">
                    <input type="hidden" name="card_id" value="{{$card->id}}" />
                    <button type="Submit" class="btn btn-primary">Update</button>
                </div>
                @endif
            </form>
            <div>
                <h1>Attachments</h1>
                <ul>
                    @foreach ($attachments as $atth)
                    <a href="{{ asset('storage/files/') }}/{{$atth->name}}">
                        <li>{{$atth->name}}</li>
                    </a>
                    @if (Auth::Check() && Auth::user()->role == 'admin' || Auth::user()->id == $atth->user_id)
                    <form method="POST" action="/delete/attachment">
                        @csrf
                        <input type="hidden" value="{{$atth->id}}" name="atth_id" />
                        <button type="submit" class="btn btn-primary btn-sm">delete</button>
                    </form>
                    @endif



                    @endforeach

                </ul>
            </div>
        </div>

    </div>


</x-app-layout>
