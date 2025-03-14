<div class="p-4 w-full">
    <div class="p-6 bg-white shadow-xl rounded-2xl">
    <h2 class="text-xl font-bold mb-4">Loan Applications</h2>

    @if(session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif


    <div class="w-full flex gap-6">

        <div class="w-1/3">
            @foreach($applications as $application)
            <div wire:click="selectApplication({{ $application->id }})" class="p-4 mb-4 border border-green-900 rounded-xl cursor-pointer {{ $selectedApplication && $selectedApplication->id == $application->id ? 'bg-blue-100' : 'bg-gray-50' }}">
                <h3 class="text-lg font-semibold">{{ $application->first_name }} {{ $application->middle_name }} {{ $application->last_name }}</h3>
                <p class="text-sm text-gray-600">Status: {{ $application->application_status }}</p>
                <p class="text-sm text-gray-600">Phone: {{ $application->phone_number }}</p>
                <p class="text-sm text-gray-600">Region: {{ $application->region }}</p>
            </div>
            @endforeach
        </div>

        <div class="w-2/3">
                @if($selectedApplication)
                    <div class="p-6 border border-green-900 rounded-xl ">
                        <h3 class="text-xl font-semibold mb-6">Full Details</h3>

                        <div class="grid grid-cols-3 gap-6">
                            <p><strong>Applicant:</strong> <span class="font-semibold">{{ $selectedApplication->first_name }} {{ $selectedApplication->middle_name }} {{ $selectedApplication->last_name }}</span></p>
                            <p><strong>Phone:</strong> <span class="font-semibold">{{ $selectedApplication->phone_number }}</span></p>
                            <p><strong>Email:</strong> <span class="font-semibold">{{ $selectedApplication->email }}</span></p>

                            <p><strong>National ID:</strong> <span class="font-semibold">{{ $selectedApplication->national_id }}</span></p>
                            <p><strong>Region:</strong> <span class="font-semibold">{{ $selectedApplication->region }}</span></p>
                            <p><strong>District:</strong> <span class="font-semibold">{{ $selectedApplication->district }}</span></p>

                            <p><strong>Street:</strong> <span class="font-semibold">{{ $selectedApplication->street }}</span></p>
                            <p><strong>Vehicle:</strong> <span class="font-semibold">{{ $selectedApplication->make_and_model }} ({{ $selectedApplication->year_of_manufacture }})</span></p>
                            <p><strong>VIN:</strong> <span class="font-semibold">{{ $selectedApplication->vin }}</span></p>

                            <p><strong>Color:</strong> <span class="font-semibold">{{ $selectedApplication->color }}</span></p>
                            <p><strong>Mileage:</strong> <span class="font-semibold">{{ number_format($selectedApplication->mileage, 0) }}</span></p>
                            <p><strong>Purchase Price:</strong> <span class="font-semibold">{{ number_format($selectedApplication->purchase_price, 2) }}</span></p>

                            <p><strong>Down Payment:</strong> <span class="font-semibold">{{ number_format($selectedApplication->down_payment, 2) }}</span></p>
                        </div>

                        <div class="mt-8 flex gap-4">
                            <button wire:click="acceptApplication({{ $selectedApplication->id }})" class="px-4 py-2 bg-green-900 text-white rounded-lg hover:bg-green-700">Accept</button>
                            <button wire:click="rejectApplication({{ $selectedApplication->id }})" class="px-4 py-2 bg-red-900 text-white rounded-lg hover:bg-red-700">Reject</button>
                        </div>


                        <livewire:application-summary.assessment />
                    </div>

                @endif
        </div>

    </div>



</div>

</div>
