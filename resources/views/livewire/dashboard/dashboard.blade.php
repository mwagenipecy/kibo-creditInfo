<div class="h-full w-full ">



@if (session()->has('message'))
        <div class="alert alert-success bg-blue-100 fw-bold text-center justify-center ">
             <strong>  {{ session('message') }}  </strong>
        </div>
    @endif


    <div class="w-full h-full grid justify-items-center">

        <div class="w-full m-auto grid justify-items-center">

            <div class="w-full bg-gray-100 rounded-lg pl-2 pr-2 pt-1 pb-1 ">
                <!-- message container -->
                <div>


                    <div class="flex">
                        <div class="container mx-auto ">

                        @if(auth()->user()->department == 1)

                         <livewire:dashboard.admin/>

                        @elseif(auth()->user()->department == 2)
                        
                        <livewire:dashboard.commerce/>
                        @elseif(auth()->user()->department == 3)

                        <livewire:dashboard.front-desk/>

                        @endif 
                        
                           

                        </div>




                    </div>







            </div>
        </div>


    </div>

</div>


</div>
