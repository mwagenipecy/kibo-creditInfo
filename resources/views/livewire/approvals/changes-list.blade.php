<div>
    @php

        $jsonArray = json_decode($edit_package, true);


    @endphp

    @if($edit_package)
        @foreach ( $jsonArray as $key => $value)



            @if($process_name == 'editUser')

             @if( App\Models\departmentsList::where('id', App\Models\User::where('id', $process_id)->value($key))->value('department_name') ==
                App\Models\departmentsList::where('id', $value)->value('department_name') )
             @else
            <div class="bg-gray-200 rounded-lg p-2 m-2">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">



                    <table class="w-full border-collapse border border-gray-300 mt-4 rounded-2xl">
                        <tbody class="text-xs">
                        <h5 class="mb-2">COLUMN : {{$key}}</h5>
                        <tr>
                            <td class="py-2 px-4 border border-gray-300">
                                CURRENT
                            </td>
                            <td class="ml-2 py-2 px-4 border border-gray-300">

                                {{ App\Models\departmentsList::where('id', App\Models\User::where('id', $process_id)->value($key))->value('department_name')  }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border border-gray-300">
                                TO BE CHANGED TO
                            </td>
                            <td class="ml-2 py-2 px-4 border border-gray-300">
                                {{ App\Models\departmentsList::where('id', $value)->value('department_name')  }}
                            </td>
                        </tr>
                        </tbody>
                    </table>



                </div>




            </div>
                @endif
            @endif

            @if($process_name == 'editRole')
            @if( App\Models\departmentsList::where('id', $process_id)->value($key)  ==  $value )
            @else
            <div class="bg-gray-200 rounded-lg p-2 m-2">


                <table class="w-full border-collapse border border-gray-300 mt-4 rounded-2xl">
                    <tbody class="text-xs">
                    <h5 class="mb-2">COLUMN : {{$key}}</h5>
                    <tr>
                        <td class="py-2 px-4 border border-gray-300">
                            CURRENT
                        </td>
                        <td class="ml-2 py-2 px-4 border border-gray-300">

                            @if($key == 'permissions')
                                <div class="">
                                    @foreach (json_decode(App\Models\departmentsList::where('id', $process_id)->value($key)) as $item)
                                        <div class="flex ">
                        <span class="text-xs ">
                            {{ \App\Models\sub_menus::where('ID', $item)->value('user_action') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                {{ App\Models\departmentsList::where('id', $process_id)->value($key) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border border-gray-300">
                            TO BE CHANGED TO
                        </td>
                        <td class="ml-2 py-2 px-4 border border-gray-300">
                            @if($key == 'permissions')
                                <div class="">
                                    @foreach (json_decode($value) as $item)
                                        <div class="flex ">
                        <span class="text-xs ">
                            {{ \App\Models\sub_menus::where('ID', $item)->value('user_action') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                {{ $value  }}
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>





            </div>
            @endif
            @endif



        @endforeach
    @endif

</div>
