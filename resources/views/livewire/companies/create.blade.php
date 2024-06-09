<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Domain\Apply\Models\Company;
use Livewire\Attributes\Rule;

new class extends Component {
    use Toast;

    #[Rule('required')]
    public string $name = '';

    #[Rule('required')]
    public string $address = '';

    public function save(): void
    {
        $data = $this->validate();

        Company::create([
            ...$data,
            'user_id' => auth()->id()
        ]);

        $this->success('Company Created success', redirectTo: '/companies');
    }

}; ?>

<div>
    <x-header title="Create Company" separator />

    <x-form wire:submit="save">
        <x-input label="Name" wire:model="name" />
        <x-input label="Address" wire:model="address" />

        <x-slot:actions>
            <x-button label="Cancel" link="/companies" />
            {{-- The important thing here is `type="submit"` --}}
            {{-- The spinner property is nice! --}}
            <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
