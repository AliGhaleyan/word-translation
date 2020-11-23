@extends("layout")
@section("title", "List Of words")

@section("content-container")

    <div class="row">
        <div class="col-12">
            <form class="form" action="{{ route("word.index") }}">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title"><h5>Title:</h5></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="word title"
                                   value="{{ request("title") ?? "" }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex bd-highlight">
        <div class="p-2 w-100 bd-highlight">
            <h2>Word List</h2>
        </div>
        <div class="p-2 flex-shrink-1 bd-highlight">
            <a href="{{ route("word.create") }}" class="btn btn-success">create new</a>
        </div>
    </div>
    <hr>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Operation</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var \App\Entities\Word $word */ ?>
            @foreach($words as $word)
                <tr>
                    <td>{{ $word->getId() }}</td>
                    <td>
                        <strong>
                            {{ $word->getTitle() }}
                        </strong>
                    </td>
                    <td class="text-muted">{{ date('Y/m/d H:i:s', strtotime($word->getCreatedAt())) }}</td>
                    <td>
                        <div class="btn-group mr-2" role="group" aria-label="Operation group">
                            <a href="{{ route("word.show", ["word" => $word->getId()]) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route("word.edit", ["word" => $word->getId()]) }}"
                               class="btn btn-sm btn-info">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger delete-word"
                                    data-url="{{ route("word.destroy", ["word" => $word->getId()]) }}">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $words->appends(request()->all())->render() }}
    </div>

@endsection

@section("scripts")
    <script>
        let csrf = "{{ csrf_token() }}";
        jQuery(function ($) {
            $(".delete-word").click(function () {
                if (!confirm("are you sure?"))
                    return;

                let url = $(this).data("url");
                $(`<form action="${url}" method="post">
                    <input type="hidden" name="_token" value="${csrf}">
                    <input type="hidden" name="_method" value="DELETE">
                    </form>`).appendTo('body').submit();
            });
        });
    </script>
@endsection
