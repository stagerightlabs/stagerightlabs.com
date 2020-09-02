@props([
  'dismissable' => false,
  'id' => '',
  'linkText' => '',
  'message' => '',
  'session' => false,
  'url' => '',
])

<x-alert.base
  :class="'bg-blue-300 p-4 border border-blue-400 text-blue-700 ' . $attributes->get('class', '')"
  :dismissable="$dismissable"
  icon="heroicon-s-information-circle"
  :id="$id"
  :linkText="$linkText"
  :message="$message"
  :session="$session"
  :url="$url"
/>
