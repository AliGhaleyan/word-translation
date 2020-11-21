@foreach(\App\Repository\Eloquent\TranslationRepository::PART_SPEECHES as $partSpeech)
    <option value="{{ $partSpeech }}"
            {{ isset($selected) && !empty($selected) && $selected == $partSpeech ? "selected" : "" }}>
        {{ ucfirst($partSpeech) }}
    </option>
@endforeach
