




{{--// cleate listerners--}}

{{--@if($this->viewMemberDetail)--}}

@if($this->viewMemberDetail)

    <div x-data="{ isOpen: false }">
        <!-- Button to open the modal -->
        <button @click="isOpen = true">Member Details</button>

        <!-- The modal -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal content -->
                @foreach($this->member as $currentMember)
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            @if($currentMember->status == "AWAITING DISBURSEMENT")
                             <div>
                                <!-- Loan Number -->
                                <div>
                                    <label class="block font-medium text-gray-700">Loan Number</label>
                                    <input type="text" value="{{$currentMember->loan_id}}"  class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Loan Number" disabled>
                                </div>

                                <!-- Client Number -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Client Number</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"  value="{{$currentMember->loan_account_number}}"  placeholder="Client Number" disabled>
                                </div>

                                <!-- Client Name -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Client Name</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{\App\Models\ClientsModel::where('id',$currentMember->client_id)->value('first_name')}}" placeholder="Client Name">
                                </div>

                                <!-- Approved Amount -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Approved Amount</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Approved Amount">
                                </div>

                                <!-- Selection Box -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Selection Box</label>
                                    <select class="form-select rounded-md shadow-sm mt-1 block w-full">
                                        <option>Select an option</option>
                                        <!-- Add your options here -->
                                    </select>
                                </div>

                                <!-- Client Amount -->
                                <div class="mt-4">
                                    <label class="block font-medium text-gray-700">Client Amount</label>
                                    <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Client Amount">
                                </div>
                            </div>

                        <!-- Modal footer -->
                           <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button @click="isOpen = false" type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Close
                            </button>
                            <button type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save
                            </button>

                           </div>
                            @endif

                           </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@else
    <div class="w-full" >
        <div class="w-fit bg-gray-200 rounded-lg pl-1 pr-1 pt-1 pb-1 m-1">
            <livewire:accounting.loans-table/>
        </div>
    </div>

@endif


{{--    @endif--}}
