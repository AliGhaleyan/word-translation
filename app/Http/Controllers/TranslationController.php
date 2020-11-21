<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTranslationRequest;
use App\Models\Translation;
use App\Repository\Eloquent\TranslationRepository;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /** @var TranslationRepository $translationRepository */
    protected $translationRepository;


    public function __construct(TranslationRepository $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }


    public function store(StoreTranslationRequest $request)
    {
        if ($this->translationRepository->create($request->validated()))
            $message = [
                "type" => "success",
                "text" => trans("messages.created", ["attribute" => "translation"])
            ];
        else
            $message = [
                "type" => "danger",
                "text" => trans("messages.cant_create", ["attribute" => "translation"])
            ];

        return back()->with("message", $message);
    }


    public function update(StoreTranslationRequest $request, Translation $translation)
    {
        $updated = $this->translationRepository->update($translation, $request->validated());

        return back()->with("message", [
            "type" => $updated ? "success" : "danger",
            "text" => trans("messages." . ($updated ? "updated" : "failed_update"), ["attribute" => "translation"])
        ]);
    }


    public function destroy(Translation $translation)
    {
        $deleted = $this->translationRepository->delete($translation);

        return back()->with("message", [
            "type" => $deleted ? "success" : "danger",
            "text" => trans("messages." . ($deleted ? "deleted" : "failed_delete"), ["attribute" => "translation"])
        ]);
    }
}
