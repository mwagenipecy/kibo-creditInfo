
<div class="w-full flex justify-center ">


                    <div class="flex items-start mt-4">
                        <ul class="nav nav-tabs flex flex-col flex-wrap list-none border-b-0 pl-0 mr-4" id="tabs-tabVertical"
                            role="tablist">
                            <li class="nav-item flex-grow text-left" role="presentation">
                                <a href="#tabs-homeVertical" class="
          nav-link
          block
          font-medium
          text-xs
          leading-tight
          uppercase
          border-x-0 border-t-0 border-b-2 border-transparent
          px-6
          py-3
          my-2
          hover:border-transparent hover:bg-gray-100
          focus:border-transparent
          active
        " id="tabs-home-tabVertical" data-bs-toggle="pill" data-bs-target="#tabs-homeVertical" role="tab"
                                   aria-controls="tabs-homeVertical" aria-selected="true">CRDB BANK LTD</a>
                            </li>
                            <li class="nav-item flex-grow text-left" role="presentation">
                                <a href="#tabs-profileVertical" class="
          nav-link
          block
          font-medium
          text-xs
          leading-tight
          uppercase
          border-x-0 border-t-0 border-b-2 border-transparent
          px-6
          py-3
          my-2
          hover:border-transparent hover:bg-gray-100
          focus:border-transparent
        " id="tabs-profile-tabVertical" data-bs-toggle="pill" data-bs-target="#tabs-profileVertical" role="tab"
                                   aria-controls="tabs-profileVertical" aria-selected="false">UCHUMI BANK LTD</a>
                            </li>
                            <li class="nav-item flex-grow text-left" role="presentation">
                                <a href="#tabs-messagesVertical" class="
          nav-link
          block
          font-medium
          text-xs
          leading-tight
          uppercase
          border-x-0 border-t-0 border-b-2 border-transparent
          px-6
          py-3
          my-2
          hover:border-transparent hover:bg-gray-100
          focus:border-transparent
        " id="tabs-messages-tabVertical" data-bs-toggle="pill" data-bs-target="#tabs-messagesVertical" role="tab"
                                   aria-controls="tabs-messagesVertical" aria-selected="false">NMB BANK LTD</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tabs-tabContentVertical">
                            <div class="tab-pane fade show active" id="tabs-homeVertical" role="tabpanel"
                                 aria-labelledby="tabs-home-tabVertical">
                                <livewire:reconciliation.reports.successiful-orders/>
                            </div>
                            <div class="tab-pane fade" id="tabs-profileVertical" role="tabpanel" aria-labelledby="tabs-profile-tabVertical">
                                <livewire:reconciliation.reports.uchumi/>
                            </div>
                            <div class="tab-pane fade" id="tabs-messagesVertical" role="tabpanel"
                                 aria-labelledby="tabs-profile-tabVertical">
                                <livewire:reconciliation.reports.nmb/>
                            </div>
                        </div>
                    </div>

</div>


