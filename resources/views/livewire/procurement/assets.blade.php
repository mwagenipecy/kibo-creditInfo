<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

       @if($this->viewPageStatus)
           <div class="w-full flex bg-blue-100 bg-dark h-10 rounded-lg mb-2 ">
               <div class="flex reading-light float-right">
                    <button wire:click="viewEmployeeList(1)" class="float-right justify-end item-end ">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                         </svg>
                    </button>
               </div>
           </div>
          <livewire:procurement.assets-list-table />
      @else
          <livewire:procurement.asset-table/>
      @endif


  </div>

