
<div>



    <div class="">



        <div class="md:grid md:grid-cols-3 md:gap-6">
            <x-jet-section-title>
                <x-slot name="title">UCHUMI Reconciliation report</x-slot>
                <x-slot name="description">{{$this->startDate}} to {{$this->endDatex}}</x-slot>
            </x-jet-section-title>
        </div>




        <div class="flex flex-col m-4 relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class="flex justify-between m-2">
                <div class="flex justify-between">
                    <div class="mr-1">
                        <x-jet-label for="startDate" value="{{ __('Start Date') }}" />
                        <x-jet-input id="startDate" type="date" class="mt-1 " wire:model="startDate" autocomplete="startDate" />
                        <x-jet-input-error for="startDate" class="mt-2" />
                    </div>
                    <div class="mr-1">
                        <x-jet-label for="endDatex" value="{{ __('End Date') }}" />
                        <x-jet-input id="endDatex" type="date" class="mt-1 " wire:model="endDatex" autocomplete="endDatex" />
                        <x-jet-input-error for="endDatex" class="mt-2" />
                    </div>
                </div>

                <div class="flex">
                    <button class=" mr-2 h-10 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" onclick="downloadPDF();">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        <span>Summary</span>
                    </button>

                    <button wire:click="downloadFullReport" class=" h-10 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" >
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        <span>Full Report</span>
                    </button>
                </div>


            </div>

            <div class="">
                <div class="">
                    <div class="overflow-hidden">
                        <table id="standings" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-right">

                                    <P>Closing balance {{number_format($this->running_balance)}}</P>

                                </th>
                            </tr>
                            </thead>
                            <tbody>



                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    ADD: Un presented Cheque
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->UpresentedCheque) }}
                                </td>
                            </tr>



                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    LESS: Interest on saving
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    0
                                </td>
                            </tr>


                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    LESS: Direct deposit
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->directDeposit) }}
                                </td>
                            </tr>


                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    LESS: Standing order
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->StandingOrder) }}
                                </td>
                            </tr>


                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    LESS: Suspense account
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->SuspenseAccount) }}
                                </td>
                            </tr>





                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-extrabold">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap  bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-bold">
                                    Total - Debit {{$this->endDatex}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-bold">
                                    {{number_format($this->lessTotal)}}
                                </td>
                            </tr>






                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    ADD : Uncredited cheque
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->UncreditedCheque) }}
                                </td>
                            </tr>




                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    ADD : Bank charges
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->bankCharges) }}
                                </td>
                            </tr>

                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    ADD : Taxes
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->taxes) }}
                                </td>
                            </tr>

                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    ADD : Direct payments
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->directPayments) }}
                                </td>
                            </tr>

                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    ADD : Cash in transit
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    {{number_format($this->CashInTransit) }}
                                </td>
                            </tr>














                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-extrabold">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap  bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-bold">
                                    Total - Credit {{$this->endDatex}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-bold">
                                    {{number_format( $this->addTotal)}}
                                </td>
                            </tr>


                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-extrabold">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap  bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-bold">
                                    Balance as per CashBook {{$this->endDatex}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right bg-white border-b text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 font-bold">
                                    {{number_format($this->mainTotal)}}
                                </td>
                            </tr>



                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Prepared by :
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-between">
                                        <div style="width: available"></div> <div>Date :</div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-between">
                                        <div>Signature :</div>
                                        <div style="width: available">______________________</div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Supervised by :
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-between">
                                        <div style="width: available"></div> <div>Date :</div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-between">
                                        <div>Signature :</div>
                                        <div style="width: available">______________________</div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Approved by :
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-between">
                                        <div style="width: available"></div> <div>Date :</div>
                                    </div>

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-between">
                                        <div>Signature :</div>
                                        <div style="width: available">______________________</div>
                                    </div>

                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>






    </div>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script type="text/javascript" src="//cdn.sheetjs.com/xlsx-latest/package/dist/shim.min.js"></script>
<script type="text/javascript" src="//cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>

<script type="text/javascript" src="//unpkg.com/blob.js@1.0.1/Blob.js"></script>
<script type="text/javascript" src="//unpkg.com/file-saver@1.3.3/FileSaver.js"></script>

<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


<script>
    function doit(type, fn, dl) {
        var elt = document.getElementById('standings');
        var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
        return dl ?
            XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
            XLSX.writeFile(wb, fn || ('SheetJSTableExport.' + (type || 'xlsx')));
    }

    function downloadPDFWithjsPDF() {


        var doc = new jspdf.jsPDF('p', 'pt', 'a3');

        doc.html(document.querySelector('#standings'), {
            callback: function (doc) {
                doc.save('MLB World Series Winners.pdf');
            },
            margin: [1, 1, 1, 1],
            x: 42,
            y: 42,
        });
    }

    function downloadPDF() {
        html2canvas($("#standings")[0], {
            allowTaint: true
        }).then(function (canvas) {
            var imgData = canvas.toDataURL('image/jpeg, 1.0');
            var pdf = new jspdf.jsPDF({
                orientation: "landscape",
                unit: "in",
                format: [12, 14]
            });

            pdf.addImage(imgData, 'jpeg', 1, 1);
            pdf.save('Report.pdf');
        });
    }


</script>

