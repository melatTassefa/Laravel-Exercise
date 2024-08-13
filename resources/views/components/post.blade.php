
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
@props(['post' ])    <!-- Receiving the variable from index-->
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user ) }}" class="font-bold">{{ $post->user->name }}</a><!-- user is a relationship in the Post model so the post model was edited first -->
        <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span><!-- diffForHumans() is a carbon method that shows the time in a human readable format, others can be found in the carbon documentation-->
        <p class="mb-2">{{ $post->body }}</p>
        {{-- @if ($post->ownedBy(auth()->user())) edited out because of policy--}}
             @can('delete', $post)  {{-- makes sure Delete option is not visible if u r not the owner --}}
                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Delete</button>
                </form>
            @endcan
        {{-- @endif --}}

        <div class="flex items-center">
        @auth
            @if(!$post->likedBy(auth()->user())) <!-- likedBy() is a method that checks if the post is liked by the authenticated user -->
                <form action="{{ route('posts.likes', $post->id ) }}" method="POST" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post->id ) }}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')   <!-- method() is a method that changes the method of the form, in this case, makes it a DELETE as specified in the route -->
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
        @endauth
            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span> <!-- Str::plural() is a helper function that pluralizes the word like -->
        </div>
    </div>
