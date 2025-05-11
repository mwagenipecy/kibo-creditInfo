<div>






    <div class="mt-2"></div>


    <div class="w-full ">


    @php
    $member = DB::table('clients')->where('id', 32)->first();
    $member_category = 22;
    @endphp

    </div>






  

            
<div class="mt-8 flex gap-4 justify-end items-right">
 @php
    $applicationStatus = DB::table('applications')
     ->where('id', session('applicationId'))
     ->value('application_status');
@endphp

@if(in_array($applicationStatus, ['ACCEPTED', 'REJECTED']))
    {{-- Application has already been processed --}}
    <div class="px-4 py-2 text-sm text-gray-600 italic">
        Application {{ strtolower($applicationStatus) }} on {{ 
            DB::table('applications')
                ->where('id', session('applicationId'))
                ->value('updated_at') 
        }}</div>
@else 
    <div class="flex space-x-4">
    <button 
      wire:click="rejectApplication" 
      class="px-4 py-2 bg-red-900 text-white rounded-lg hover:bg-red-700 transition-colors"
        >
      Reject Application
        </button>
     <button 
         wire:click="acceptApplication" 
      class="px-4 py-2 bg-green-900 text-white rounded-lg hover:bg-green-700 transition-colors"
        >
       Accept Application
        </button>
    </div>
@endif
        </div>
</div>