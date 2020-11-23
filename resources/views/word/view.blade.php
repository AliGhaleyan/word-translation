@extends("layout")
@section("title", "Create new Word")

@section("content")

    <div class="container-fluid mt-5">

        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>View "{{ $word->getTitle() }}" word detail</h3>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Part Speech</th>
                                        <th>Created at</th>
                                        <th>Operation</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($translations as $translate)
                                        <tr id="show-row-{{ $translate->getId() }}" class="show-row">
                                            <td>{{ $translate->getId() }}</td>
                                            <td>
                                                <strong>
                                                    {{ $translate->getTitle() }}
                                                </strong>
                                            </td>
                                            <td class="text-muted">{{ ucfirst($translate->getPartSpeech()) }}</td>
                                            <td class="text-muted">{{ $translate->getCreatedAt() }}</td>
                                            <td>
                                                <div class="btn-group mr-2" role="group" aria-label="Operation group">
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary show-edit-translation"
                                                            data-id="{{ $translate->getId() }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-translation"
                                                            data-url="{{ route("translation.destroy", ["translation" => $translate->getId()]) }}">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr id="edit-row-{{ $translate->getId() }}" style="display: none" class="edit-row">
                                            <td>{{ $translate->getId() }}</td>
                                            <td>
                                                <input type="text" id="translation-title-{{ $translate->getId() }}"
                                                       value="{{ $translate->getTitle() }}">
                                            </td>
                                            <td>
                                                <select type="text" id="translation-part-speech-{{ $translate->getId() }}">
                                                    <x-part-speech-options selected="{{ $translate->getPartSpeech() }}"/>
                                                </select>
                                            </td>
                                            <td class="text-muted">{{ $translate->getCreatedAt() }}</td>
                                            <td>
                                                <div class="btn-group mr-2" role="group" aria-label="Operation group">
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary edit-translation"
                                                            data-id="{{ $translate->getId() }}"
                                                            data-url="{{ route("translation.update", ["translation" => $translate->getId()]) }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary cancel-edit"
                                                            data-id="{{ $translate->getId() }}">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Create Translation:</h5>
                                @include('include.validation-errors')
                            </div>
                            <div class="card-body">
                                <form action="{{ route("translation.store") }}" method="post" class="form">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" name="title" placeholder="title" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="part_speech">
                                            <x-part-speech-options/>
                                        </select>
                                    </div>

                                    <input type="hidden" value="{{ $word->getId() }}" name="word_id">
                                    <button type="submit" class="btn btn-outline-success">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>

    </div>

@endsection


@section("scripts")
    <script>
        let csrf = "{{ csrf_token() }}";
        let wordId = "{{ $word->getId() }}";

        jQuery(function ($) {
            $(".show-edit-translation").click(function () {
                let id = $(this).data("id")
                resetRowsDisplay();
                $("#show-row-" + id).hide()
                $("#edit-row-" + id).show()
            });

            $(".cancel-edit").click(function () {
                resetRowsDisplay();
            });

            $(".delete-translation").click(function () {
                if (!confirm("are you sure?"))
                    return;

                let url = $(this).data("url");
                $(`<form action="${url}" method="post">
                    <input type="hidden" name="_token" value="${csrf}">
                    <input type="hidden" name="_method" value="DELETE">
                    </form>`).appendTo('body').submit();
            });

            $(".edit-translation").click(function () {
                let id = $(this).data("id"), url = $(this).data("url"), inputsStr = "";
                let tr = $("#edit-row-" + id);
                let data = {
                    "word_id": wordId,
                    "title": tr.find("#translation-title-" + id).val(),
                    "part_speech": tr.find("#translation-part-speech-" + id).val(),
                    "_method": "PUT",
                    "_token": csrf
                };

                for (let key in data)
                    inputsStr += `<input type="hidden" name="${key}" value="${data[key]}">\n`;

                $(`<form action="${url}" method="post">${inputsStr}</form>`).appendTo('body').submit();
            });

            function resetRowsDisplay() {
                $(".edit-row").hide()
                $(".show-row").show()
            }
        });
    </script>
@endsection
