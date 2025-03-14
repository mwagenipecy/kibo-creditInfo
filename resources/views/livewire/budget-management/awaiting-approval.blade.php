<div>
    {{-- Do your work, then step back. --}}
    <div class="p-4">
        <div class="w-full flex">
            <div class="w-1/5 ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400  ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 ">
                            Product name
                        </th>
                    </tr>
                    </thead>
                    @foreach($this->pending_budget as $category)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{   ucfirst(str_replace('_', ' ', $category->sub_category_name)) }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="w-4/5 border-l">
                <div class="relative overflow-x-auto  sm:rounded-lg ">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>


                            <th scope="col" class="px-6 py-3 ">
                                january
                            </th>

                            <th scope="col" class="px-6 py-3">
                                february
                            </th>
                            <th scope="col" class="px-6 py-3">
                                march
                            </th>
                            <th scope="col" class="px-6 py-3">
                                april
                            </th>
                            <th scope="col" class="px-6 py-3">
                                may
                            </th>
                            <th scope="col" class="px-6 py-3">
                                june
                            </th>
                            <th scope="col" class="px-6 py-3">
                                july
                            </th>
                            <th scope="col" class="px-6 py-3">
                                august
                            </th> <th scope="col" class="px-6 py-3">
                                september
                            </th> <th scope="col" class="px-6 py-3">
                                october
                            </th> <th scope="col" class="px-6 py-3">
                                november
                            </th> <th scope="col" class="px-6 py-3">
                                december
                            </th> <th scope="col" class="px-6 py-3">
                                year
                            </th>
                            </th> <th scope="col" class="px-6 py-3">
                                total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($this->pending_budget as $budget)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <th scope="row" class="px-6  py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{number_format($budget->january,2)}}
                                </th>
                                <td class="px-6 py-4">
                                    {{number_format($budget->february,2)}}

                                </td>
                                <td class="px-6 py-4">
                                    {{number_format($budget->march,2)}}

                                </td>
                                <td class="px-6 py-4">
                                    {{number_format($budget->april,2)}}

                                </td>
                                <td class="px-6 py-4">
                                    {{number_format($budget->may,2)}}

                                </td>
                                <td class="px-6 py-4">
                                    {{number_format($budget->june,2)}}
                                </td>  <td class="px-6 py-4">
                                    {{number_format($budget->july,2)}}
                                </td>  <td class="px-6 py-4">
                                    {{number_format($budget->august,2)}}
                                </td>  <td class="px-6 py-4">
                                    {{number_format($budget->september,2)}}
                                </td>  <td class="px-6 py-4">
                                    {{number_format($budget->october,2)}}
                                </td> </td>  <td class="px-6 py-4">
                                    {{number_format($budget->november,2)}}
                                </td>

                                </td>

                                <td class="px-6 py-4">
                                    {{number_format($budget->december,2)}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$budget->year}}
                                </td>

                                <td class="px-6 py-4">
                                    {{number_format($budget->total,2)}}
                                </td>
                                <td class="flex items-center px-6 py-2 space-x-3">
                                    <button wire:click="approveBudget({{$budget->id}})" type="button" class="text-white bg-gray-100 hover:bg-red-100 hover:text-red focus:ring-4 focus:outline-none focus:ring-red-100 font-medium rounded-lg text-sm  text-center inline-flex items-center mr-2 dark:bg-red-200 dark:hover:bg-red-200 dark:focus:ring-red-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="sr-only">approve</span>
                                    </button>

                                    <button wire:click="declineBudget({{$budget->id}})" type="button" class="text-white bg-gray-100 hover:bg-red-100 hover:text-red focus:ring-4 focus:outline-none focus:ring-red-100 font-medium rounded-lg text-sm  text-center inline-flex items-center mr-2 dark:bg-red-200 dark:hover:bg-red-200 dark:focus:ring-red-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="sr-only">decline</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
                    <div class="flex item-float-right float-right align-right mt-4 space-x-2">
                        <button wire:click="approveAll" type="button" class="ml-auto inline-flex items-center py-1 px-1 text-sm text-center text-white bg-gradient-to-br    bg-red-400   rounded-lg shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"  >

                            <div wire:loading wire:target="approveAll">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 spin">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div wire:loading.remove wire:target="approveAll">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            APPROVE ALL
                        </button>

                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
