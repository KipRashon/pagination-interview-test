<div>
    <!-- Items per page selection -->
    <div style="margin-bottom: 1rem;">
        <label for="perPage">Items per page:</label>
        <select wire:model="perPage" id="perPage">
            @foreach($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
    </div>
    <!-- Items list -->
    <div>
        @forelse($items as $item)
            <div>{{ $item->name }}</div>
        @empty
            <div>No items available.</div>
        @endforelse
    </div>

    <div style="margin-top: 1rem;">
        {{ $items->onEachSide(1)->links() }} <!-- Limit pagination links for performance -->
    </div>
</div>
