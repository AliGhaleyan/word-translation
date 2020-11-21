@foreach(\App\Repository\Eloquent\TranslationRepository::PART_SPEECHES as $partSpeech)
    <option value="{{ $partSpeech }}">{{ ucfirst($partSpeech) }}</option>
@endforeach
