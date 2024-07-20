<div>
    <select wire:model="design.status" name="statuses" class="form-control" required>
        @foreach ($statuses as $status)
            <option value="{{ $status }}">{{ $status }}</option>
        @endforeach
    </select>
</div>
