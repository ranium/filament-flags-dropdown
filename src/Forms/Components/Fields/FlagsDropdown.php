<?php

namespace Ranium\FlagsDropdown\Forms\Components\Fields;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Select;

class FlagsDropdown extends Select
{
    use HasOptions;

    protected string $view = 'filament-flags-dropdown::forms.components.fields.flags-dropdown';

    protected ?\Closure $onChangeCallback = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->extraAttributes(config('filament-flags-dropdown.extra_attributes'));
        $this->extraInputAttributes(config('filament-flags-dropdown.extra_input_attributes'));
    }

    public function getNormalizedOptions(): array
    {
        $normalizedOptions = [];

        foreach ($this->getOptions() as $flag => $option) {
            $normalizedOptions[is_array($option) ? $option['value'] : $option] = [
                'flag' => $flag,
                'label' => is_array($option) ? $option['label'] : $option,
            ];
        }

        return $normalizedOptions;
    }

    public function onChange(\Closure $callback): static
    {
        $this->onChangeCallback = $callback;

        $this->registerOnChangeListeners();

        return $this;
    }

    private function registerOnChangeListeners(): void
    {
        $eventName = $this->getName().'::changed';

        $this->registerListeners([
            $eventName => [
                function (Component $component, string $statePath, ?string $newValue, ?string $oldValue): void {
                    if (is_callable($this->onChangeCallback)) {
                        $callable = $this->onChangeCallback;
                        $callable($newValue, $oldValue);
                    }
                },
            ],
        ]);
    }
}
