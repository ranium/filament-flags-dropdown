<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div {{ $attributes->merge($getExtraAttributes())->class(['filament-forms-select-component group flex items-center space-x-1 rtl:space-x-reverse']) }}>
        @if (($prefixAction = $getPrefixAction()) && (! $prefixAction->isHidden()))
            {{ $prefixAction }}
        @endif

        @if ($icon = $getPrefixIcon())
            <x-dynamic-component :component="$icon" class="h-5 w-5" />
        @endif

        @if (filled($label = $getPrefixLabel()))
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif
        <div
            x-data="{
                state: $wire.entangle('{{ $getStatePath() }}').defer,
                isPlaceholderSelectionDisabled: @js($isPlaceholderSelectionDisabled()),
                options: @js($getNormalizedOptions()),
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (! this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                },
                init() {
                    if (this.isPlaceholderSelectionDisabled && ! this.state) {
                        this.state = Object.keys(this.options)[0] ?? ''
                    }
                }
            }"
            x-init="init()"
            x-on:keydown.escape.prevent.stop="close($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
            x-id="['flags-dropdown-button']"
            class="relative min-w-0 flex-1"
        >
            <!-- Button -->
            <button
                {!! $isAutofocused() ? 'autofocus' : null !!}
                {!! $isDisabled() ? 'disabled' : null !!}
                id="{{ $getId() }}"
                x-ref="button"
                x-on:click="toggle()"
                :aria-expanded="open"
                :aria-controls="$id('flags-dropdown-button')"
                type="button"
                {{
                    $attributes->merge($getExtraInputAttributes())->class([
                        'flex items-center gap-x-2.5 filament-forms-input w-full rounded-lg text-gray-900 shadow-sm outline-none transition duration-75 border focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 px-2 py-2 bg-white',
                        'dark:bg-gray-700 dark:text-white dark:focus:border-primary-500' => config('forms.dark_mode'),
                        'border-gray-300' => ! $errors->has($getStatePath()),
                        'dark:border-gray-600' => (! $errors->has($getStatePath())) && config('forms.dark_mode'),
                        'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),
                        'dark:border-danger-400 dark:ring-danger-400' => $errors->has($getStatePath()) && config('forms.dark_mode'),
                    ])
                }}
            >
                <template x-if="state">
                    <div class="w-full text-left">
                        <span class="px-4 fi" x-bind:class="'fi-' + options[state]['flag']"></span> <span x-text="options[state]['label']"></span>
                    </div>
                </template>

                <template x-if="!state">
                    <span class="px-2 w-full text-left">{{ $getPlaceholder() }}</span>
                </template>

                <!-- Heroicon: chevron-down -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Panel -->
            <div
                x-ref="panel"
                x-show="open"
                x-transition.origin.top.left
                x-on:click.outside="close($refs.button)"
                :id="$id('flags-dropdown-button')"
                style="display: none;"
                {{
                    $attributes->merge()->class([
                        'absolute left-0 mt-1 w-full rounded-md bg-white p-1 shadow-md overflow-hidden',
                        'dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 dark:border-gray-600' => config('forms.dark_mode'),
                    ])
                }}
            >
                @php
                    $itemAttributes = $attributes->merge()->class([
                        'flex items-center group w-full whitespace-nowrap rounded-md p-2 text-left text-sm hover:text-white hover:bg-primary-500 disabled:text-gray-500',
                        'dark:text-white dark:focus:border-primary-500 dark:border-gray-600' => config('forms.dark_mode'),
                    ])
                @endphp

                @unless ($isPlaceholderSelectionDisabled())
                    <a
                        href="#"
                        x-show="state"
                        x-on:click.prevent="state = ''; close($refs.button)"
                        {{ $itemAttributes }}
                    >
                        {{ $getPlaceholder() }}
                    </a>
                @endif

                @foreach($getNormalizedOptions() as $value => $option)
                    <a
                        href="#"
                        x-on:click.prevent="state = '{{ $value }}'; close($refs.button)"
                        {{ $itemAttributes }}
                    >
                        <span class="mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 fi fi-{{ $option['flag'] }}"></span> {{ $option['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
        @if (filled($label = $getSuffixLabel()))
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif

        @if ($icon = $getSuffixIcon())
            <x-dynamic-component :component="$icon" class="h-5 w-5" />
        @endif

        @if (($suffixAction = $getSuffixAction()) && (! $suffixAction->isHidden()))
            {{ $suffixAction }}
        @endif
    </div>
</x-dynamic-component>
