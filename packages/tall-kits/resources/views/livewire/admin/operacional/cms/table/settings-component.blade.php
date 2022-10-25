<div x-data="{ 'showSettings': @entangle('showSettings').defer }">
    <button wire:click="showSetting(true)" type="button"
        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9">
        <x-tall-icon name="cog" />
    </button>
    <div class="mt-2 flex flex-col space-y-2">
        <x-tall-table.settings>
            <div class="flex items-center justify-between py-2 px-4">
                <p class="flex shrink-0 items-center space-x-1.5">
                    <x-tall-icon name="cog" />
                    <span class="text-xs">{{ $model->table_name }}</span>
                </p>
                <button wire:click="showSetting(false)"
                    class="btn -mr-1 h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <x-tall-icon name="x" />
                </button>
            </div>
            <x-tall-table.settings-tab tab="tabColumns" title="{{ __('Habilitados') }}">
                <x-slot name="action">
                    <label class="relative flex px-3">
                        <input
                            class="form-input peer h-8 w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 text-xs+ ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="Search here..." type="text" />
                        <span
                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <x-tall-icon name="search" class="h-4.5 w-4.5 transition-colors duration-200" />
                        </span>
                    </label>
                </x-slot>
                @if ($Columns = $this->columns)
                    <div class="py-2" x-init="Sortable.create($el, {
                        animation: 200,
                        easing: 'cubic-bezier(0, 0, 0.2, 1)',
                        delay: 150,
                        delayOnTouchOnly: true,
                        draggable: '.board-draggable',
                        handle: '.board-draggable-handler',
                        store: {
                            get: function(sortable) {
                                var order = [];
                                console.log(sortable.options.group.name);
                                return order;
                            },
                            set: function(sortable) {
                                var order = sortable.toArray();
                                $wire.groupUpdatedOrder(order.join('|'));
                            }
                        }
                    })">
                        @foreach ($selecteds as $name => $key)
                            <div data-id="{{ $key }}"
                                class="flex justify-between items-center board-draggable">
                                <label class="inline-flex items-center space-x-2 py-1">
                                    <input value="{{ $name }}" wire:model='selecteds.{{ $name }}'
                                        class="form-switch h-5 w-10 rounded-lg bg-slate-300 before:rounded-md before:bg-slate-50 checked:bg-slate-500 checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-navy-400 dark:checked:before:bg-white"
                                        type="checkbox" />
                                    <span>{{ $name }}</span>
                                </label>
                                <div class="flex space-x-2">
                                    <button wire:click="setActiveSettingsTab('{{ $name }}')" class="p-0">
                                        <x-tall-icon name="pencil-alt" />
                                    </button>
                                    <span class="p-0  board-draggable-handler cursor-pointer">
                                        <x-tall-icon name="arrows-expand" />
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3 px-3">
                        <h2 class="text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            {{ __('Desabilitados') }}
                        </h2>
                        @foreach ($Columns as $Column)
                            @if (!Arr::has($selecteds, $Column->getName()))
                                @if (!Arr::get($selecteds, $Column->getName()))
                                    <div class="flex justify-between items-center board-draggable">
                                        <label class="inline-flex items-center space-x-2 py-1">
                                            <input value="{{ $Column->getName() }}"
                                                wire:model='selecteds.{{ $Column->getName() }}'
                                                class="form-switch h-5 w-10 rounded-lg bg-slate-300 before:rounded-md before:bg-slate-50 checked:bg-slate-500 checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-navy-400 dark:checked:before:bg-white"
                                                type="checkbox" />
                                            <span>{{ $Column->getName() }}</span>
                                        </label>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>

                @endif
            </x-tall-table.settings-tab>
            <x-tall-table.settings-tab tab="tabColumnDetail" title="Editar {{ data_get($modelColumn, 'name') }}">
                @if ($modelColumn)
                    <form wire:submit.prevent="save"
                        class="flex h-full w-full transform-gpu flex-col bg-white transition-transform duration-200 dark:bg-navy-700">
                        <div class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto p-4">
                            <label class="block">
                                <span>{{ __('Nome') }}</span>
                                <input readonly
                                    class="form-input mt-1.5 h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="text" wire:model.defer='form_data.name' />
                            </label>
                            <label class="block">
                                <span>{{ __('Alias') }}</span>
                                <input placeholder="{{ __('Alias') }}"
                                    class="form-input mt-1.5 h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="text" wire:model.defer='form_data.alias' />
                            </label>

                            <label class="block">
                                <span>{{ __('View') }}:</span>
                                <select wire:model.defer='form_data.view' x-init="$el._x_tom = new Tom($el)" class="mt-1.5 w-full"
                                    placeholder="{{ __('Selecione uma view') }}" autocomplete="off">
                                    @if ($load_table_components = $this->load_table_components)
                                        @foreach ($load_table_components as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </label>
                            <label class="block">
                                <span>{{ __('Text') }}</span>
                                <input
                                    class="form-input mt-1.5 h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="{{ __('Label') }}" type="text"
                                    wire:model.defer='form_data.text' />
                            </label>
                            <label class="block">
                                <span>{{ __('Link') }}</span>
                                <input
                                    class="form-input mt-1.5 h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="{{ __('Link') }}" type="text"
                                    wire:model.defer='form_data.link' />
                            </label>
                            <label class="block" for="sortable" x-tooltip.primary="'Marcar para ordenar'">
                                <input value="1" id="sortable" wire:model.defer='form_data.sortable'
                                    class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                    type="checkbox" />
                                <span>{{ __('Sortable') }}</span>
                            </label>
                            <label class="block" for="searchable" x-tooltip.primary="'Marcar para pesquisar'">
                                <input value="1" id="searchable" wire:model.defer='form_data.searchable'
                                    class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                    type="checkbox" />
                                <span>{{ __('Searchable') }}</span>
                            </label>
                            <label class="block" for="visible" x-tooltip.primary="'Marcar para pesquisar'">
                                <input value="1" id="visible" wire:model.defer='form_data.visible'
                                    class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                    type="checkbox" />
                                <span>{{ __('Visible') }}</span>
                            </label>
                            <label class="block">
                                <span>{{ __('Colspan') }}</span>
                                <input
                                    class="form-input mt-1.5 h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="{{ __('Colspan') }}" type="text"
                                    wire:model.defer='form_data.colspan' />
                            </label>
                            <label class="block">
                                <span>{{ __('Width') }}</span>
                                <input
                                    class="form-input mt-1.5 h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="{{ __('Width') }}" type="text"
                                    wire:model.defer='form_data.width' />
                            </label>

                        </div>
                        <div
                            class="flex items-center justify-between border-t border-slate-150 py-3 px-4 dark:border-navy-600">
                            <div class="flex space-x-1">
                                <button type="button" wire:click="delete()"
                                    class="btn h-8 w-8 rounded-full p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewbox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <button type="button" wire:click="setActiveSettingsTab(null,'tabColumns')"
                                    class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewbox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </button>
                            </div>
                            <button type="submit"
                                class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Save
                            </button>
                        </div>
                    </form>
                @endif

            </x-tall-table.settings-tab>
        </x-tall-table.settings>
    </div>

</div>
