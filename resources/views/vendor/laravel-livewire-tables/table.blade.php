<div>
    <div class="flex items-center justify-between my-3">
        <div class="flex items-center">
            <div class="">
                <span class="">Search:</span>
            </div>
            <input type="search" class="px-4 py-2 ml-4 bg-gray-200 rounded hover:border-gray-300 focus:border-gray-300"  wire:model="search">
        </div>
    @if($header_view)
        <div class="w-full">
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
                                        @if($sort_direction == 'desc')
                                            <svg class="inline-block h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                            </svg>
                                        @else
                                            <svg class="inline-block h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor"viewBox="0 0 24 24">
                                                <path d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                            </svg>
                                        @endif
                                    @else
                                        <svg class="inline-block h-5 text-gray-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                        </svg>
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
                            @if($this->clickable_row) 
                                hover:bg-yellow-200 cursor-pointer 
                            @endif 
                            align-center {{ $this->trClass($model) }}"
                        >
                        @if($checkbox && $checkbox_side == 'left')
                            @include('laravel-livewire-tables::checkbox-row')
                        @endif

                        @foreach($columns as $column)
                            <td class="px-4 py-2 {{ $this->tdClass($column->attribute, $value = Arr::get($model->toArray(), $column->attribute)) }}"
                                @if($this->clickable_row)
                                    wire:click="rowClick({{$model->id}})"
                                @endif
                                >
                                @if($column->view)
                                    @include($column->view)
                                @else
                                    {!! $this->tdPresenter($column->attribute, $value) !!}
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
