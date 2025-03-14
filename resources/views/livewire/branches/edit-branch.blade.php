<div>

        <div >

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="membershipNumber" value="{{ __('Clientship Number') }}" />
                <x-jet-input id="membershipNumber" type="text" class="mt-1 block w-full" wire:model.defer="membershipNumber" disabled/>
                <x-jet-input-error for="membershipNumber" class="mt-2" />
            </div>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Branch Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />

                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="region" value="{{ __('Region') }}" />
                <x-jet-input id="region" type="text" class="mt-1 block w-full" wire:model.defer="region" autocomplete="region" />
                <x-jet-input-error for="region" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="wilaya" value="{{ __('Wilaya') }}" />
                <x-jet-input id="wilaya" type="text" class="mt-1 block w-full" wire:model.defer="wilaya" autocomplete="wilaya" />
                <x-jet-input-error for="wilaya" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

        </div>
</div>

