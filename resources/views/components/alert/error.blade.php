@props([
  'dismissable' => false,
  'id' => '',
  'linkText' => '',
  'message' => '',
  'session' => false,
  'url' => '',
])

<x-alert.base
  :class="'bg-red-300 p-4 border border-red-400 text-red-700 ' . $attributes->get('class', '')"
  :dismissable="$dismissable"
  icon="heroicon-s-x-circle"
  :id="$id"
  :linkText="$linkText"
  :message="$message"
  :session="$session"
  :url="$url"
/>
