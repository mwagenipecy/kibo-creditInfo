
<div class="w-2/3">
    <!-- message container -->

    @if(Session::get('showAddUser'))
        <livewire:branches.add-user/>
    @elseif(Session::get('showEditBranch'))
    <livewire:branches.edit-branch/>
    @else

    <div>
        <div class="mb-12 shadow-sm">
            <p for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</p>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.debounce="term" type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-400 dark:focus:border-blue-400" placeholder="Search by name, number or location..." required>
                <button wire:click="resetSearch" class="text-white absolute right-1.5 bottom-1.5 top-1.5 bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                    <div wire:loading.remove wire:target="term">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div wire:loading wire:target="term" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                        </svg>
                    </div>
                </button>

            </div>
        </div>

        <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">

            @foreach($this->branches as $branch)


                <div class="flex items-center justify-between ">

                    <div class="flex-1 pl-2">
                        <p class="text-gray-700 font-semibold">
                            {{$branch->name}} : {{$branch->branch_status}}
                        </p>
                        <p class="text-gray-600 font-thin">
                            {{$branch->region}} - {{$branch->wilaya}} : Clientship No {{$branch->membershipNumber}}
                        </p>
                    </div>
                    <p class="text-blue-400">{{App\Models\Clients::count()}} Clients</p>

                    @if( Session::get('userRole') == 'Officer')
                    <div class="flex items-center space-x-5 ml-5" >

                        <svg wire:click="editBranch({{$branch->id}},'{{$branch->name}}')" xmlns="http://www.w3.org/2000/svg" class="h-9 bg-slate-50 rounded-full stroke-slate-400 p-2 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>

                        @if(App\Models\Clients::where('branch_id',$branch->id)->count() < 1)
                            <div wire:loading wire:target="deleteBranch" >


                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                    </svg>

                            </div>

                            <div wire:loading.remove wire:target="deleteBranch" >

                                <svg wire:click="deleteBranch({{$branch->id}})" xmlns="http://www.w3.org/2000/svg"
                                     class=" @if( Session::get('userRole') != 'Officer') pointer-events-none @endif  h-9 bg-slate-50 rounded-full stroke-slate-400 p-2 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>

                            </div>

                        @endif


                        <svg xmlns="http://www.w3.org/2000/svg" wire:click="AddUser({{$branch->id}},'{{$branch->name}}')"
                             class="h-9 bg-slate-50 rounded-full stroke-slate-400 p-2 cursor-pointer" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>

                    </div>
                    @endif


                </div>

                <hr class="boder-b-0 my-4"/>
            @endforeach

        </div>
    </div>

    @endif

</div>
