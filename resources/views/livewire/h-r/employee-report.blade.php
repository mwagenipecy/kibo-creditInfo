<div>
    <div class="flex flex-row gap-6 justify-between w-full">
        @if (in_array( "Create and View employee" , session()->get('permission_items')))
        <div class=" w-1/2">
            <form class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="employeeN">Employee Name:</label>
                    <select wire:model="employeeN" id="employeeN" class="rounded bg-gray-100 border-none" >
                        <option selected value="" class="text-sm">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value = {{ $employee->id }}>
                                {{ $employee->first_name.' '.$employee->last_name }}
                            </option>
                        @endforeach

                    </select>
                    @error('employeeN')
                    <span class="flex bg-red-200 italic rounded p-2 w-fit h-fit border text-red-600 border-red-400 mt-2">Name is required</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="docName">Document Name:</label>
                    <input type="text" id="docName" wire:model="docName" class="rounded bg-gray-100 border-none">
                    @error('docName')
                    <span class="flex bg-red-200 italic rounded p-2 w-fit h-fit text-red-600   border border-red-400 mt-2">Document Name is required</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="employeeFile">Document:</label>
                    <input type="file" id="employeeFile" wire:model="employeeFile" class="rounded bg-gray-100 border-none">
                    @error('employeeFile')
                    <span class="flex bg-red-200 italic rounded p-2 w-fit h-fit text-red-600   border border-red-400 mt-2">A Document is required</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="flex w-fit bg-red-100 rounded p-2  " wire:click.prevent="addDocDetails">Submit</button>
                </div>


            </form>
        </div>
        @endif
        <div class="flex flex-col w-1/2">
            <div class="flex flex-col mt-3">
                <div class="flex flex-row justify-between -mt-4">
                    <span class="font-bold">Employee Name:</span>
                    <span class="font-bold">Doc Name:</span>
                    <span class="font-bold">Action:</span>
                </div>
                    @foreach($empFiles as $datafile)
                        <div class="flex flex-row p-1 bg-red-200 justify-between rounded mb-2 mt-2    ">
                            <div class="flex p-1 w-96">{{ $datafile->empName }}</div>
                            <div class="flex p-1 w-96">{{ $datafile->docName }}</div>
                            <button wire:click="downloadFile({{ $datafile->id }})" class="bg-gray-600 text-white rounded p-1 mt-2 mb-2 ">Download</button>
                        </div>
                    @endforeach


            </div>
        </div>
    </div>

</div>
