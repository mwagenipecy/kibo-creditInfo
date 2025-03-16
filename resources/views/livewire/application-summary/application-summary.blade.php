<div class="p-4 w-full">
    <div class="p-6 bg-white shadow-xl rounded-2xl">
    <h2 class="text-xl font-bold mb-4">Loan Applications</h2>

    @if(session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif


    <div class="w-full flex gap-6">

        <div class="w-1/4">
            @foreach($applications as $application)
            <div wire:click="selectApplication({{ $application->id }})" class="p-4 mb-4 border border-green-900 rounded-xl cursor-pointer {{ $selectedApplication && $selectedApplication->id == $application->id ? 'bg-blue-100' : 'bg-gray-50' }}">
                <h3 class="text-lg text-xs ">{{ $application->first_name }} {{ $application->middle_name }} {{ $application->last_name }}</h3>
                <p class="text-sm text-gray-600">Status: {{ $application->application_status }}</p>
                <p class="text-sm text-gray-600">Phone: {{ $application->phone_number }}</p>
                <p class="text-sm text-gray-600">Region: {{ $application->region }}</p>
            </div>
            @endforeach
        </div>

        <div class="w-3/4">
                @if($selectedApplication)
                    <div class="p-6 border border-green-900 rounded-xl ">
                        <h3 class="text-xl text-xs  mb-6">Full Details</h3>

                        <div class="grid grid-cols-3 gap-6">
                            <p><strong>Applicant:</strong> <span class="text-xs ">{{ $selectedApplication->first_name }} {{ $selectedApplication->middle_name }} {{ $selectedApplication->last_name }}</span></p>
                            <p><strong>Phone:</strong> <span class="text-xs ">{{ $selectedApplication->phone_number }}</span></p>
                            <p><strong>Email:</strong> <span class="text-xs ">{{ $selectedApplication->email }}</span></p>

                            <p><strong>National ID:</strong> <span class="text-xs ">{{ $selectedApplication->national_id }}</span></p>
                            <p><strong>Region:</strong> <span class="text-xs ">{{ $selectedApplication->region }}</span></p>
                            <p><strong>District:</strong> <span class="text-xs ">{{ $selectedApplication->district }}</span></p>

                            <p><strong>Street:</strong> <span class="text-xs ">{{ $selectedApplication->street }}</span></p>
                            <p><strong>Vehicle:</strong> <span class="text-xs ">{{ $selectedApplication->make_and_model }} ({{ $selectedApplication->year_of_manufacture }})</span></p>
                            <p><strong>VIN:</strong> <span class="text-xs ">{{ $selectedApplication->vin }}</span></p>

                            <p><strong>Color:</strong> <span class="text-xs ">{{ $selectedApplication->color }}</span></p>
                            <p><strong>Mileage:</strong> <span class="text-xs ">{{ number_format($selectedApplication->mileage, 0) }}</span></p>
                            <p><strong>Purchase Price:</strong> <span class="text-xs ">{{ number_format($selectedApplication->purchase_price, 2) }}</span></p>

                            <p><strong>Down Payment:</strong> <span class="text-xs ">{{ number_format($selectedApplication->down_payment, 2) }}</span></p>
                        </div>

                       


                        <livewire:application-summary.assessment />


                    </div>

                @endif
        </div>

    </div>



</div>

</div>
