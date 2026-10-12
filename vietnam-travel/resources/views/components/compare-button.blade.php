
@props(['place'])

<button
    type="button"
    class="compare-add-btn"
    data-place-id="{{ $place->id }}"
    data-place-name="{{ $place->name }}"
    aria-pressed="false"
>
    + So sánh
</button>
