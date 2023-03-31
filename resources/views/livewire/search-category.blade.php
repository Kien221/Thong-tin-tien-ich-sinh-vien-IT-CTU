<div>
    <input wire:model="search" type="text" placeholder="Search users..."/>
    <ul>
        @foreach($data as $category)
            <li>{{ $category->CategoryName }}</li>
        @endforeach
    </ul>
</div>