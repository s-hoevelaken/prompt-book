@props(['users'])

<div class="my-8">
    {{ $users->links('vendor.pagination.tailwind') }}
</div>