@foreach(\App\Repository\Eloquent\TranslationRepositoryEloquent::PART_SPEECHES as $partSpeech)
    <option value="{{ $partSpeech }}">{{ ucfirst($partSpeech) }}</option>
@endforeach
