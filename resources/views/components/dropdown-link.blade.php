@php
$classAttr = $attributes->get('class', '');
$hasCustomTextColor = preg_match('/(?:^|\s)text-(?:[a-z]+)-\d+/', $classAttr);
$hasCustomHoverBg = preg_match('/(?:^|\s)hover:bg-/', $classAttr);

$defaultClasses = 'flex items-center gap-3 w-full px-3 py-2 rounded-xl text-xs font-bold focus:outline-none transition-all duration-150 ease-in-out ' 
    . ($hasCustomTextColor ? '' : 'text-slate-700 hover:text-indigo-600 ')
    . ($hasCustomHoverBg ? '' : 'hover:bg-slate-100 ');
@endphp

<a {{ $attributes->merge(['class' => trim($defaultClasses)]) }}>{{ $slot }}</a>
