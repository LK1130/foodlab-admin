 {{-- Starts Table --}}

 <table class="table mt-5">
     <tr class="tableHeader">
         <td>{{ __('messageZY.number') }}</td>
         <td>{{ __('messageZY.changeby') }}</td>
         <td>{{ __('messageZY.kyat') }}</td>
         <td>{{ __('messageZY.date') }}</td>
         <td>{{ __('messageZY.note') }}</td>
     </tr>
     @php
         $count = 1;
         $color = '';
     @endphp
     @forelse ($admins as $admin)
         @if ($loop->first)
             <tr class="tableChile bg-success">
                 @php
                     $color = 'tdWhite';
                 @endphp
             @else
             <tr class="tableChile">
                 @php
                     $color = 'tdBlack';
                 @endphp
         @endif
         <td class="{{ $color }}">{{ $count++ }}</td>
         <td class="{{ $color }}">{{ $admin->ad_name }}</td>
         <td class="{{ $color }}">{{ number_format($admin->old_rate) }} =>
             {{ number_format($admin->new_rate) }}
         </td>
         <td class="{{ $color }}">{{ $admin->created }} </td>
         <td class="{{ $color }}">{{ $admin->change_note }} </td>
         </tr>
     @empty
         <td>{{ __('messageZY.noHistory') }} .</td>

     @endforelse
 </table>
 <div class="d-flex justify-content-center ">{{ $admins->links() }}</div>
