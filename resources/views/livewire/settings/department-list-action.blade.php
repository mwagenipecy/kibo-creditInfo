<div class="" >


    <div class="flex flex-wrap max-w-64 border-blue-500 rounded-md">

        @php
            $str_json = json_encode($permissions);
                $menuItems= json_decode($str_json, TRUE);
                $menuItems = str_replace(array('[',']','"',' '), '',$menuItems);

                $menuItems = explode(",",$menuItems);
                // Sort the menuItems array in ascending order
                sort($menuItems);
        @endphp
        @foreach($menuItems as $permission)
            <div class="flex-shrink-0 w-1/4 p-2">
                <span class="text-sm">{{ App\Models\sub_menus::where('id',$permission)->value('user_action') }}</span>
            </div>
        @endforeach

    </div>

</div>
