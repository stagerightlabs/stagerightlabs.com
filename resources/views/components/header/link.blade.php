@props([
  'label',
  'url' => '#',
  'mobile' => false,
  'target' => null,
])

@inject('str', 'Illuminate\Support\Str')

@php
  // Generally speaking, we can assume this link is "active" if the first part
  // of the current URL matches the link's URL.
  $active = $str->startsWith(request()->url(), $url)
    && $url != '#'
    && $url != route('home');

  // However, the base route is a special case. We only want this to be
  // active when we are actually on the home page.
  if (request()->url() == $url) {
    $active = true;
  }

  // For blog posts, we will consider the "blog" link active
  // if any part of the request URL contains the word "blog"
  if ($str->contains(request()->url(), 'blog') && $slot == 'Blog') {
    $active = true;
  }

  if ($mobile && $active) {
    $attributes = $attributes->merge([
      'class' => 'block px-3 py-2 rounded-md text-base font-medium text-cool-gray-200 bg-gray-900
                  focus:outline-none focus:text-cool-gray-200 focus:bg-gray-700 transition
                  duration-150 ease-in-out hover:text-white'
    ]);
  } elseif ($mobile && ! $active) {
    $attributes = $attributes->merge([
      'class' => 'block px-3 py-2 rounded-md text-base font-medium text-cool-gray-300 hover:text-white
                  hover:bg-gray-600 focus:outline-none focus:text-white focus:bg-gray-700 transition
                  duration-150 ease-in-out'
    ]);
  } elseif ($active) {
    $attributes = $attributes->merge([
      'class' => 'px-3 py-2 rounded-md text-sm leading-5 font-medium text-white bg-gray-900
                  focus:outline-none focus:text-white focus:bg-gray-700 transition
                  duration-150 ease-in-out'
    ]);
  } else {
    $attributes = $attributes->merge([
      'class' => 'px-3 py-2 rounded-md text-sm leading-5 font-medium text-gray-300 hover:text-white
                  hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition
                  duration-150 ease-in-out'
    ]);
  }
@endphp

<a
  href="{{ $url }}"
  {{ $attributes }}
  @if ($target)
  target="{{ $target }}"
  @endif
>
  {{ $slot }}
</a>
