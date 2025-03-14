
<div>
    <div class="p-4">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <!-- Content -->
            <div class="">
                <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">

                    <div>

                        <table class="min-w-full text-center text-sm font-light">
                            <thead>
                                <tr>
                                    <th>PAYMENTS PROCESSOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="whitespace-nowrap font-medium text-left">Active Products</td>
                                    <td class="whitespace-nowrap text-left"></td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap font-medium text-left">Inactive Products</td>
                                    <td class="whitespace-nowrap text-left"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard actions -->
        <div class="flex w-full mb-4 gap-2">

            <!-- Left: Avatars -->


            <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-1 flex  items-center " style="height: 70px">


                <div class="inline-flex p-2" >



{{--                        @if (in_array(23, session()->get('permissions')))--}}
                            <button wire:click="menuItemClicked(1) " class="mr-4 flex text-center items-center @if($this->tab_id == 1)bg-green-100 @else bg-gray-100  @endif @if($this->tab_id == 1) text-green-900 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#00FFBF'; this.style.color='';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                                New Order
                            </button>
{{--                        @endif--}}

{{--                        @if (in_array(23, session()->get('permissions')))--}}
                        <button wire:click="menuItemClicked(2)" class="mr-4 flex text-center items-center @if($this->tab_id == 2) bg-green-100 @else bg-gray-100  @endif @if($this->tab_id == 2) text-green-900 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#00FFBF'; this.style.color='';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                            Manage Orders
                        </button>
{{--                    @endif--}}

{{--                    @if (in_array(23, session()->get('permissions')))--}}
                    <button wire:click="menuItemClicked(3)" class="mr-4 flex text-center items-center @if($this->tab_id == 3) bg-green-100 @else bg-gray-100  @endif @if($this->tab_id == 3) text-green-900 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#00FFBF'; this.style.color='';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                        Approvals
                    </button>
{{--                @endif--}}

{{--                @if (in_array(23, session()->get('permissions')))--}}
                <button wire:click="menuItemClicked(4)" class="mr-4 flex text-center items-center @if($this->tab_id == 4)bg-green-100 @else bg-gray-100  @endif @if($this->tab_id == 4) text-green-100 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#00FFBF'; this.style.color='';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>

                    Orders status
                </button>
{{--                @endif--}}




                </div>



            </div>





            <!-- Right: Actions -->


        </div>


        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <div class="tab-pane fade " id="tabs-homeJustify"
                 role="tabpanel" aria-labelledby="tabs-home-tabJustify">
                <div class="mt-2"></div>
                <div class="w-full flex items-center justify-center">
                    <div wire:loading wire:target="setView">
                        <div class="h-96 m-auto flex items-center justify-center">
                            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
                        </div>
                    </div>
                </div>





            </div>

            @if($this->tab_id == 1 )
            <livewire:payments.new-order/>
            @endif

            @if($this->tab_id == 2 )
                <livewire:payments.manage-order/>
            @endif

            @if($this->tab_id == 3 )
                <livewire:payments.approvals/>
            @endif

        </div>


    </div>





</div>

