@section('title')
{{ $snippet->name }}
@endsection

<div>
  <x-card heading="{{ $snippet->name }}">
    {!! $snippet->rendered !!}
  </x-card>
</div>
