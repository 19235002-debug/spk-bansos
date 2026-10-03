@php
$classAttr = $attributes->get('class', '');
$hasCustomTextColor = preg_match('/(?:^|\s)text-(?:[a-z]+)-\d+/', $classAttr);
$hasCustomHoverBg = preg_match('/(?:^|\s)hover:bg-/', $classAttr);

$defaultClasses = 'flex items-center gap-2.5 w-full px-4 py-2.5 text-xs font-semibold focus:outline-none transition duration-150 ease-in-out ' 
    . ($hasCustomTextColor ? '' : 'text-slate-700 hover:text-indigo-600 ')
    . ($hasCustomHoverBg ? '' : 'hover:bg-slate-100/80 ');
@endphp

<a {{ $attributes->merge(['class' => trim($defaultClasses)]) }}>{{ $slot }}</a>
