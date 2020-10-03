@section('title')
{{ $post->title }}
@endsection

@section('meta')
<x-meta.post :post="$post" />
@endsection

<div>
  <x-card class="mb-8">
    <x-post :post="$post" />
  </x-card>
  <x-author />
</div>
