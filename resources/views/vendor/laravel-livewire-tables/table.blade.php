<div>
    <div class="flex my-3">
        <div class="flex items-center">
            <div class="">
                <span class="">Search:</span>
            </div>
            <input type="search" class="ml-4 py-2 px-4 bg-gray-200 hover:border-gray-300  focus:border-gray-300 rounded"  wire:model="search">
        </div>
    @if($header_view)
        <div class="">
            @include($header_view)
        </div>
    @endif
    </div>

    <div class="">
        @if($models->isEmpty())
            <div class="">
                {{ __('No results to display.') }}
            </div>
        @else
            <table class="mt-4 mb-2 table-fixed bg-white border shadow-lg w-full {{ $table_class }}">
                <thead class="{{ $thead_class }}">
                <tr>
                    @if($checkbox && $checkbox_side == 'left')
                        @include('laravel-livewire-tables::checkbox-all')
                    @endif

                    @foreach($columns as $column)
                        <th class="p-4 {{ $this->thClass($column->attribute) }}">
                            @if($column->sortable)
                                <span style="cursor: pointer;" wire:click="sort('{{ $column->attribute }}')">
                                    {{ $column->heading }}

                                    @if($sort_attribute == $column->attribute)
                                        <i class="fa fa-sort-amount-{{ $sort_direction == 'asc' ? 'up-alt' : 'down' }}"></i>
                                    @else
                                        <i class="fa fa-sort-amount-up-alt" style="opacity: .35;"></i>
                                    @endif
                                </span>
                            @else
                                {{ $column->heading }}
                            @endif
                        </th>
                    @endforeach

                    @if($checkbox && $checkbox_side == 'right')
                        @include('laravel-livewire-tables::checkbox-all')
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($models as $model)

                    <tr class="{{ $loop->index %2==0 ? 'bg-teal-500 bg-opacity-10' :'' }} 
                            @if($this->clickable_row) hover:bg-yellow-200 cursor-pointer 
                            @endif 
                            align-center {{ $this->trClass($model) }}"
                            @if($this->clickable_row)
                            onclick="window.location='{{ $this->clicktarget }}/{{$model->id}}';"
                            @endif
                        >
                        @if($checkbox && $checkbox_side == 'left')
                            @include('laravel-livewire-tables::checkbox-row')
                        @endif

                        @foreach($columns as $column)
                            <td class="px-4 py-2 {{ $this->tdClass($column->attribute, $value = Arr::get($model->toArray(), $column->attribute)) }}">
                                @if($column->view)
                                    @include($column->view)
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach

                        @if($checkbox && $checkbox_side == 'right')
                            @include('laravel-livewire-tables::checkbox-row')
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="">
        <div class="livewire-pagination">
            {{ $models->links('layouts.livewire-pagination') }}
        </div>
        @if($footer_view)
            <div class="col-md-auto">
                @include($footer_view)
            </div>
        @endif
    </div>
</div>
