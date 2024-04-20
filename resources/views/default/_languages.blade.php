@php
$languages = [
    'Afrikaans', 'Arabic', 'Bengali', 'Bulgarian', 'Chinese', 'Croatian', 'Czech', 'Danish',
    'Dutch', 'English', 'Estonian', 'Farsi', 'Finnish', 'French', 'German', 'Greek', 'Hebrew',
    'Hindi', 'Hungarian', 'Icelandic', 'Indonesian', 'Irish', 'Italian', 'Japanese', 'Korean',
    'Latvian', 'Lithuanian', 'Malay', 'Maori', 'Norwegian', 'Polish', 'Portuguese', 'Punjabi',
    'Romanian', 'Russian', 'Samoan', 'Scottish Gaelic', 'Serbian', 'Slovak', 'Slovenian',
    'Spanish', 'Swahili', 'Swedish', 'Tagalog', 'Tahitian', 'Thai', 'Turkish', 'Urdu',
    'Vietnamese', 'Welsh', 'Yiddish'];
@endphp

@foreach ($languages as $language)
    <option value="{{ $language }}">{{ $language }}</option>
@endforeach