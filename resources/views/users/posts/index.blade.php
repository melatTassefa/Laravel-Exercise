@extends('layouts.app')
@section('content')
<div>
    <div class="w-8/12">
        <div class="p-6">
            <h1 class="text-2xl font-medium mb-1">{{$user->name}}</h1>
            <p> Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{ $user->receivedLikes->count() }} likes</p>
        </div>
        <div class=" bg-white p-6 rounded-lg">
            @if($posts->count())   <!-- counts() is a method that checks if there are any posts -->
            @foreach($posts as $post)
                <x-post :post="$post"/> <!-- x-post is the name of the component and we're sending the variable to be used-->
            @endforeach
            {{ $posts->links() }} <!-- links() is a method that paginates the posts -->
            @else
            <p>{{ $user->name }} does not have any posts.</p>
            @endif
        </div>
    </div>
</div>
@endsection

