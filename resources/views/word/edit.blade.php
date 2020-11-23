@extends("layout")
@section("title")
    Edit {{ $word->getTitle() }} word
@endsection

@section("content-container")

    <div class="card">
        <div class="card-header">
            <h3>Edit {{ $word->getTitle() }} word</h3>
            @include('include.validation-errors')
        </div>

        <div class="card-body">
            <form action="{{ route("word.update", ["word" => $word->getId()]) }}" class="form" method="post">
                @csrf
                <input name="_method" type="hidden" value="PUT">

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" placeholder="title" name="title"
                           value="{{ $word->getTitle() }}" autofocus autocomplete="off" class="form-control">
                </div>

                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>

@endsection
