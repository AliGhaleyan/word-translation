<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Word;
use App\Repository\Eloquent\WordRepository;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    /** @var WordRepository $wordRepository */
    protected $wordRepository;

    public function __construct(WordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }


    public function index()
    {
        return view("word.index", [
            "words" => $this->wordRepository->paginate(5)
        ]);
    }


    public function store(StoreWordRequest $request)
    {
        if ($this->wordRepository->create($request->validated()))
            $message = [
                "type" => "success",
                "text" => trans("messages.created", ["attribute" => "word"])
            ];
        else
            $message = [
                "type" => "danger",
                "text" => trans("messages.failed_create", ["attribute" => "word"])
            ];

        return redirect(route("word.index"))->with("message", $message);
    }


    public function create()
    {
        return view("word.create");
    }


    public function show(Word $word)
    {
        $translations = $word->translations()->get();

        return view("word.view", compact("word", "translations"));
    }


    public function edit(Word $word)
    {
        return view("word.edit", compact("word"));
    }


    public function update(Word $word, UpdateWordRequest $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string" .
                ($request->input("title") != $word->title ? "|unique:words" : ""),
        ]);
        if ($validator->fails())
            return back()->withErrors($validator);

        $updated = $this->wordRepository->update($word, $request->validated());

        return redirect(route("word.index"))->with("message", [
            "type" => $updated ? "success" : "danger",
            "text" => trans("messages." . ($updated ? "updated" : "failed_update"), ["attribute" => "word"])
        ]);
    }


    public function destroy(Word $word)
    {
        $deleted = $this->wordRepository->delete($word);

        return back()->with("message", [
            "type" => $deleted ? "success" : "danger",
            "text" => trans("messages." . ($deleted ? "deleted" : "failed_delete"), ["attribute" => "word"])
        ]);
    }
}
