<?php

namespace Ranium\FlagsDropdown\Forms\Components\Fields;

use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Select;

class FlagsDropdown extends Select
{
    use HasOptions;

    protected string $view = 'filament-flags-dropdown::forms.components.fields.flags-dropdown';

    protected function setUp(): void
    {
        parent::setUp();

        $this->extraAttributes(config('filament-flags-dropdown.extra_attributes'));
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
}
