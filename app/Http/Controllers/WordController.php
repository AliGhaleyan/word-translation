<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Entities\Word;
use App\Mutation\Doctrine\WordMutation;
use App\Repository\Doctrine\WordRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class WordController
 * @package App\Http\Controllers
 *
 * @method Word findById($id)
 */
class WordController extends BaseController
{
    public function __construct(WordRepository $wordRepository, WordMutation $wordMutation)
    {
        $this->repository = $wordRepository;
        $this->mutation = $wordMutation;
    }


    public function index(Request $request)
    {
        $page = $request->input("page", 1);
        $perPage = $request->input("per_page", 5);
        $filter = [
            "title" => $request->input("title")
        ];

        return view("word.index", [
            "words" => $this->repository->setFilter($filter)->paginate($page, $perPage)
        ]);
    }


    public function store(StoreWordRequest $request)
    {
        $title = $request->input("title");

        $word = new Word($title);

        if ($this->mutation->create($word, $request->validated()))
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


    public function show($id)
    {
        $word = $this->findById($id);

        $translations = $word->getTranslations();

        return view("word.view", compact("word", "translations"));
    }


    public function edit($id)
    {
        $word = $this->findById($id);

        return view("word.edit", compact("word"));
    }


    public function update($id, UpdateWordRequest $request)
    {
        $word = $this->findById($id);

        $validator = Validator::make($request->all(), [
            "title" => "required|string" .
                ($request->input("title") != $word->getTitle() ? ("|unique:" . Word::class) : ""),
        ]);
        if ($validator->fails())
            return back()->withErrors($validator);

        $updated = $this->mutation->update($word, $request->validated());

        return redirect(route("word.index"))->with("message", [
            "type" => $updated ? "success" : "danger",
            "text" => trans("messages." . ($updated ? "updated" : "failed_update"), ["attribute" => "word"])
        ]);
    }


    public function destroy($id)
    {
        $word = $this->findById($id);

        $deleted = $this->mutation->delete($word);

        return back()->with("message", [
            "type" => $deleted ? "success" : "danger",
            "text" => trans("messages." . ($deleted ? "deleted" : "failed_delete"), ["attribute" => "word"])
        ]);
    }
}
