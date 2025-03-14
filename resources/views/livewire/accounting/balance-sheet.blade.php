<div>

    <div class="p-2 shadow-md sm:rounded-lg bg-gray-100">



        <div class="relative overflow-x-auto rounded-lg bg-white p-4 mb-2">


            <div class="text-l font-bold">
                Balance sheet
            </div>
            <div class="text-sm font-semibold mb-4">
                Summary
            </div>

            <div id="summary">

                <table class="w-full text-sm text-left text-red-100 dark:text-blue-100">
                    <thead class="text-xs text-white uppercase bg-red-400 dark:text-white">
                    <tr>
                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                            Description
                        </th>
                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                            Estimate for Current FY
                        </th>
                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                            Actual for Current FY
                        </th>
                        <th scope="col" class="px-6 py-4 dark:border-neutral-500">
                            Estimate for Next FY
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-red-50 border-b border-red-400 text-black">
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-black">
                            Total Assets
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            @php
                                $totalIncome = 0; // Initialize the total income
                                foreach($asset_accounts as $income_account){
                                    $category_accounts = Illuminate\Support\Facades\DB::table($income_account->category_name)->get();
                                    $total_amount = 0;
                                    foreach($category_accounts as $category_account){
                                        $total_amount += Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code', $category_account->sub_category_code)->value('balance');
                                    }
                                    $totalIncome += $total_amount;
                                }
                                echo number_format($totalIncome, 2);
                            @endphp
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalIncome, 2) }}
                        </td>
                        <td class="px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalIncome, 2) }}
                        </td>
                    </tr>
                    <tr class="bg-blue-50 border-b border-red-400 text-black">
                        <td class="border-r px-6 py-4 dark-border-neutral-500">
                            Total Liabilities
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            @php
                                $totalExpenses = 0; // Initialize the total expenses
                                foreach($liability_accounts as $expense_account){
                                    $category_accounts = Illuminate\Support\Facades\DB::table($expense_account->category_name)->get();
                                    $total_amount = 0;
                                    foreach($category_accounts as $category_account){
                                        $total_amount += Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code', $category_account->sub_category_code)->value('balance');
                                    }
                                    $totalExpenses += $total_amount;
                                }
                                echo number_format($totalExpenses, 2);
                            @endphp
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalExpenses, 2) }}
                        </td>
                        <td class="px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalExpenses, 2) }}
                        </td>
                    </tr >

                    <tr class="bg-red-50 border-b border-red-400 text-black">
                        <td class="border-r px-6 py-4 dark-border-neutral-500">
                            Total Equity
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            @php
                                $totalExpensesx = 0; // Initialize the total expenses
                                foreach($capital_accounts as $expense_account){
                                    $category_accounts = Illuminate\Support\Facades\DB::table($expense_account->category_name)->get();
                                    $total_amount = 0;
                                    foreach($category_accounts as $category_account){
                                        $total_amount += Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code', $category_account->sub_category_code)->value('balance');
                                    }
                                    $totalExpensesx += $total_amount;
                                }
                                echo number_format($totalExpensesx, 2);
                            @endphp
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalExpensesx, 2) }}
                        </td>
                        <td class="px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalExpensesx, 2) }}
                        </td>
                    </tr >


                    <tr class="text-xs text-white uppercase bg-red-400 dark:text-white">
                        <td class="border-r px-6 py-4 dark-border-neutral-500">
                            Assets = Liabilities + Equity
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalIncome, 2) }} = {{ number_format($totalExpenses, 2) }} + {{ number_format($totalExpensesx, 2) }}
                        </td>
                        <td class="border-r px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalIncome, 2) }} = {{ number_format($totalExpenses, 2) }} + {{ number_format($totalExpensesx, 2) }}
                        </td>
                        <td class="px-6 py-4 dark:border-neutral-500 text-right">
                            {{ number_format($totalIncome, 2) }} = {{ number_format($totalExpenses, 2) }} + {{ number_format($totalExpensesx, 2) }}
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>



        </div>


        <div class="relative overflow-x-auto rounded-lg bg-white p-4">


            <div class="text-l font-bold">
                Balance sheet
            </div>
            <div class="text-sm font-semibold mb-4">
                Details
            </div>

            <table class="w-full text-sm text-left text-red-100 dark:text-blue-100">

                <div class="">

                    <thead class="text-xs text-white uppercase bg-red-400 dark:text-white">
                    <tr>

                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ASSETS
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">

                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ESTIMATE ASSETS FOR CURRENT FINANCIAL YEAR
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ACTUAL ASSETS FOR CURRENT FINANCIAL YEAR
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ESTIMATE ASSETS FOR NEXT FINANCIAL YEAR
                        </th>

                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $main_total_amount= 0;
                    @endphp

                    @foreach($asset_accounts as $income_account)
                        <tr class="bg-red-50 border-b border-red-400 text-black">
                            <td class="whitespace-nowrap border-r px-4 py-2 dark:border-neutral-500 text-sm">
                                {{ ucwords(str_replace('_', ' ', $income_account->category_name)) }}
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 dark:border-neutral-500 text-sm">
                                @php
                                    $category_accounts = Illuminate\Support\Facades\DB::table($income_account->category_name)->get();
                                @endphp
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                                {{ $category_account->sub_category_code }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 text-sm">
                                                {{
                                                Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('account_name')
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @php
                                    $total_amount= 0;
                                @endphp
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @php
                                        $total_amount= $total_amount + Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance');
                                    @endphp
                                @endforeach
                                @php
                                    $main_total_amount= $main_total_amount + $total_amount;
                                @endphp
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>


                </div>



                <tr class="text-xs text-white uppercase bg-red-400 dark:text-white">

                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                        TOTAL ASSETS
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 ">

                    </td>
                    <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                        {{number_format($main_total_amount,2)}}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                        {{number_format($main_total_amount,2)}}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                        {{number_format($main_total_amount,2)}}
                    </td>

                </tr>

                <tr class="bg-white mb-8">
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                </tr>


                <div class="overflow-hidden relative overflow-x-auto rounded-lg mt-4">

                    <thead class="text-xs text-white uppercase bg-red-400 dark:text-white">
                    <tr>

                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            LIABILITIES
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">

                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ESTIMATE LIABILITIES FOR CURRENT FINANCIAL YEAR
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ACTUAL LIABILITIES FOR CURRENT FINANCIAL YEAR
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ESTIMATE LIABILITIES FOR NEXT FINANCIAL YEAR
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $main_total_expenses= 0;
                    @endphp
                    @foreach($liability_accounts as $expense_account)
                        <tr class="bg-red-50 border-b border-red-400 text-black">
                            <td class="whitespace-nowrap border-r px-4 py-2 dark:border-neutral-500 text-sm">
                                {{ ucwords(str_replace('_', ' ', $expense_account->category_name)) }}
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 dark:border-neutral-500 text-sm">
                                @php
                                    $category_accounts = Illuminate\Support\Facades\DB::table($expense_account->category_name)->get();
                                    $total_expenses = 0;
                                @endphp

                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                                {{ $category_account->sub_category_code }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 text-sm">
                                                {{
                                                Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('account_name')
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @php
                                        $total_expenses= $total_expenses + Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance');
                                    @endphp
                                @endforeach
                                @php
                                    $main_total_expenses= $main_total_expenses + $total_expenses;
                                @endphp
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach

                    <tr class="text-xs text-white uppercase bg-red-400 dark:text-white">

                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                            TOTAL LIABILITIES
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 ">

                        </td>
                        <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                            {{number_format($main_total_expenses,2)}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                            {{number_format($main_total_expenses,2)}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                            {{number_format($main_total_expenses,2)}}
                        </td>

                    </tr>

                    </tbody>

                </div>





                <tr class="bg-white mb-8">
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                    <td class="">

                    </td>
                </tr>


                <div class="overflow-hidden relative overflow-x-auto rounded-lg mt-4">

                    <thead class="text-xs text-white uppercase bg-red-400 dark:text-white">
                    <tr>

                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            EQUITY
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">

                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ESTIMATE EQUITY FOR CURRENT FINANCIAL YEAR
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ACTUAL EQUITY FOR CURRENT FINANCIAL YEAR
                        </th>
                        <th
                                scope="col"
                                class="border-r px-6 py-4 dark:border-neutral-500">
                            ESTIMATE EQUITY FOR NEXT FINANCIAL YEAR
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $main_total_expenses= 0;
                    @endphp
                    @foreach($capital_accounts as $expense_account)
                        <tr class="bg-red-50 border-b border-red-400 text-black">
                            <td class="whitespace-nowrap border-r px-4 py-2 dark:border-neutral-500 text-sm">
                                {{ ucwords(str_replace('_', ' ', $expense_account->category_name)) }}
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 dark:border-neutral-500 text-sm">
                                @php
                                    $category_accounts = Illuminate\Support\Facades\DB::table($expense_account->category_name)->get();
                                    $total_expenses = 0;
                                @endphp

                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                                {{ $category_account->sub_category_code }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 text-sm">
                                                {{
                                                Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('account_name')
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @php
                                        $total_expenses= $total_expenses + Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance');
                                    @endphp
                                @endforeach
                                @php
                                    $main_total_expenses= $main_total_expenses + $total_expenses;
                                @endphp
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap border-r px-4 py-2 font-medium dark:border-neutral-500 text-sm">
                                @foreach($category_accounts as $category_account)
                                    <table class="table-auto">
                                        <tbody>
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500 flex text-right w-full text-sm">
                                                {{
                                                number_format(Illuminate\Support\Facades\DB::table('accounts')->where('sub_category_code',$category_account->sub_category_code)->value('balance'),2)
                                                }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach

                    <tr class="text-xs text-white uppercase bg-red-400 dark:text-white">

                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                            TOTAL EQUITY
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 ">

                        </td>
                        <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                            {{number_format($main_total_expenses,2)}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                            {{number_format($main_total_expenses,2)}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 text-right font-medium">
                            {{number_format($main_total_expenses,2)}}
                        </td>

                    </tr>

                    </tbody>

                </div>



            </table>

        </div>


    </div>

</div>
