@extends("layout")
@section("title", "Create new Word")

@section("content-container")

    <div class="card">
        <div class="card-header">
            <h3>Create new Word</h3>
            @include('include.validation-errors')
        </div>

        <div class="card-body">
            <form action="{{ route("word.store") }}" class="form" method="post">
                @csrf

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" placeholder="title" name="title" autocomplete="off" class="form-control"
                           value="{{ old("title") }}" autofocus>
                </div>

                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>

@endsection



{{--<div class="form-group" id="translations">--}}
{{--    <h5>Translations:</h5>--}}
{{--    <div class="row">--}}
{{--        <div class="col">--}}
{{--            <input type="text" class="form-control" placeholder="translation title"--}}
{{--                   id="translation-title">--}}
{{--        </div>--}}
{{--        <div class="col">--}}
{{--            <select class="form-control" id="translation-part-speech">--}}
{{--                <option value="verbs">Verbs</option>--}}
{{--                <option value="adjectives">Adjectives</option>--}}
{{--                <option value="adverbs">Adverbs</option>--}}
{{--                <option value="conjunctions">Conjunctions</option>--}}
{{--                <option value="interjections">Interjections</option>--}}
{{--                <option value="nouns">Nouns</option>--}}
{{--                <option value="prepositions">Prepositions</option>--}}
{{--                <option value="pronouns">Pronouns</option>--}}
{{--                <option value="articles">Articles</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="col">--}}
{{--            <button type="button" class="btn btn-primary">Add</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
