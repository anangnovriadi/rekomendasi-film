@extends('front.layout.app')

@section('add_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('front/tagify/tagify.css') }}">
@endsection

@section('title', 'Profile')

@section('content')

<div class="container-cus">
    <div class="pb-4">
        <h4 class="gray-g">My Profile</h4>
    </div>
    <form action="{{ route('edit.profile') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="hidden" name="id" value={{ $user->id }} />
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Enter email" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Firstname</label>
                    <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" placeholder="Enter Firstname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Lastname</label>
                    <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}" placeholder="Enter Lastname">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Film(Liked)</label>
                    <input type="text" name="nama_film_liked" class="form-control" value="{{ $user->nama_film_liked }}" placeholder="Nama Film">
                    {{-- <input type="text" name="nama_film_liked" class="form-control" value="{{ preg_replace('/\s+/',', ',str_replace(array("\r\n","\r","\n"),' ',trim($user->nama_film_liked))) }}" placeholder="Nama Film"> --}}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Genre Film(Liked)</label>
                    <input type="text" name="genre_film_liked" class="form-control" value="{{ preg_replace('/\s+/',', ',str_replace(array("\r\n","\r","\n"),' ',trim($user->genre_film_liked))) }}" placeholder="Genre Film">
                </div>
            </div>
        </div>
        <div class="pt-3">
            <div class="form-group">
                <button type="submit" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading" class="btn btn-primary">Edit Profile</button>
            </div>
        </div>
    </form>
</div>
<br>

@section('add_js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $('.btn').on('click', function() {
        var $this = $(this);
        $this.button('loading');
    });
</script>

<script src="{{ asset('front/tagify/tagify.min.js') }}"></script>
<script src="{{ asset('front/tagify/jQuery.tagify.min.js') }}"></script>
<script data-name="basic">
    (function(){
    // "remove all tags" button event listener
    document.querySelector('.tags--removeAllBtn')
        .addEventListener('click', tagify.removeAllTags.bind(tagify))

    // Chainable event listeners
    tagify.on('add', onAddTag)
            .on('remove', onRemoveTag)
            .on('input', onInput)
            .on('invalid', onInvalidTag)
            .on('click', onTagClick);

    // tag added callback
    function onAddTag(e){
        console.log(e.detail);
        console.log("original input value: ", input.value)
        tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
    }

    // tag remvoed callback
    function onRemoveTag(e){
        console.log(e.detail);
        console.log("tagify instance value:", tagify.value)
    }

    // on character(s) added/removed (user is typing/deleting)
    function onInput(e){
        console.log(e.detail);
    }

    // invalid tag added callback
    function onInvalidTag(e){
        console.log(e.detail);
    }

    // invalid tag added callback
    function onTagClick(e){
        console.log(e.detail);
    }

    })()
</script>

        
<script data-name="textarea">
    (function(){
    // var input = document.querySelector('input[name=nama_film_liked]'),
    //     tagify = new Tagify(input, {
    //         enforceWhitelist : true,
    //         whitelist        : {!! json_encode($nama_film) !!},
    //         callbacks        : {
    //             add    : console.log, 
    //             remove : console.log
    //         }
    //     });
    var inputGenre = document.querySelector('input[name=genre_film_liked]'),
        tagify = new Tagify(inputGenre, {
            enforceWhitelist : true,
            whitelist        : {!! json_encode($genre_film) !!},
            callbacks        : {
                add    : console.log, 
                remove : console.log
            }
        });
    })()
</script>
@endsection
@endsection