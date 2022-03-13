@if ($type == 1)
    <span class="text-success fs-4">{{ $message }}</span>
@elseif ($type == 2)
    <span class="text-info fs-4">{{ $message }}</span>
@elseif ($type == 3)
    <span class="text-warning fs-4">{{ $message }}</span>
@elseif ($type == 4)
    <span class="text-secondary fs-4">{{ $message }}</span>
@endif
