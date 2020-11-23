<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTranslationRequest;
use App\Entities\Translation;
use App\Mutation\Doctrine\TranslationMutation;
use App\Repository\Doctrine\TranslationRepository;

/**
 * Class TranslationController
 * @package App\Http\Controllers
 *
 * @method Translation findById($id)
 */
class TranslationController extends BaseController
{
    public function __construct(TranslationRepository $translationRepository, TranslationMutation $translationMutation)
    {
        $this->mutation = $translationMutation;
        $this->repository = $translationRepository;
    }


    public function store(StoreTranslationRequest $request)
    {
        $title = $request->input("title");
        $partSpeech = $request->input("part_speech");
        $translate = new Translation($title, $partSpeech);

        if ($this->mutation->create($translate, $request->validated()))
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


    public function update(StoreTranslationRequest $request, $id)
    {
        $translation = $this->findById($id);

        $updated = $this->mutation->update($translation, $request->validated());

        return back()->with("message", [
            "type" => $updated ? "success" : "danger",
            "text" => trans("messages." . ($updated ? "updated" : "failed_update"), ["attribute" => "translation"])
        ]);
    }


    public function destroy($id)
    {
        $translation = $this->findById($id);

        $deleted = $this->mutation->delete($translation);

        return back()->with("message", [
            "type" => $deleted ? "success" : "danger",
            "text" => trans("messages." . ($deleted ? "deleted" : "failed_delete"), ["attribute" => "translation"])
        ]);
    }
}
