<div>
    {{-- Do your work, then step back. --}}
    <div class="w-full flex ">
        <div class="w-3/4">

        </div>
        <div class="w-1/3 w-100">
            <input wire:model="day_date" type="date" class="mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">

        </div>

    </div>

    <div class="w-full flex items-center justify-center ">
        <div wire:loading wire:target="selectedBranch">
            <div class="h-96 m-auto flex items-center justify-center">
                <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-500"></div>
            </div>
        </div>
    </div>
    <div wire:loading.remove wire:target="selectedBranch">
    </div>

    <div class="bg-gray-100 p-2 rounded-lg">


    <div class="w-full mb-1 flex gap-1">
        <div class="w-1/3 bg-white rounded-2xl p-4">
            <table class="w-full rounded-2xl">
                <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Institution Branches</th>
                </tr>
                </thead>
                <tbody>
                @foreach(DB::table('branches')->get() as $branch )

                <tr wire:click="selectedBranch({{$branch->id}})" class=" cursor-pointer @if($this->tab_id == $branch->id) text-white bg-red-600 @endif
                        hover:bg-red-500 rounded-lg">
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{$branch->name}}
                    </td>
                </tr>
                    @endforeach


                </tbody>
            </table>
        </div>



        <div class="w-2/3 bg-white rounded-2xl p-4 relative">

            <div class="w-full mb-1 flex gap-1 bg-gray-200 p-1 rounded-2xl ">

                <div class="w-full bg-white rounded-2xl p-4">
                   @if($this->tab_id)



                        <div class="fw-bold">

                            <div class="text-center text-underline justify-center align-center text-base lighting item-center flex font-bold uppercase">
                                {{DB::table('branches')->where('id',$this->tab_id)->value('name')}}
                            </div>

                            <div class="w-full mx-auto bg-white p-4 rounded-lg shadow">
                                <table class="w-full">
                                    <thead>
                                    <tr>
                                        <td class="py-2">Total Principle :</td>
                                        <td class="py-2 fw-light">{{ number_format($this->total_principle,2) }} TZS</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="border-t-2">
                                        <td class="py-2">Total Disbursement  :</td>
                                        <td class="py-2">{{ number_format($this->total_disbursement_amount,2) }} TZS</td>
                                    </tr>
                                    <tr class="border-t-2">
                                        <td class="py-2"> Total Loan Application:</td>
                                        <td class="py-2">{{ $this->loan_applications }}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                       @else
                        <p class="font-semibold ">no data to display </p>

                       @endif

                </div>

            </div>


            <div class="flex items-end w-full absolute bottom-0 mb-4 ">

            </div>

        </div>

    </div>
    </div>
</div>
