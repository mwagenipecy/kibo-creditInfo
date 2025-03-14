<?php

namespace App\Http\Livewire\ProfileSetting;

use App\Models\AccountsModel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class OnBold extends Component
{
    public function render()
    {
        return view('livewire.profile-setting.on-bold');
    }

    public function setAccount(){
     // create table general accounts

        Schema::dropIfExists('GL_accounts');
        Schema::create('GL_accounts',function (Blueprint $table){
            $table->id();
            $table->bigInteger('account_code')->unique();
            $table->string('account_name', 100);
            $table->timestamps();
        });

        // insert data
//        DB::table('GL_accounts')->insert([
//            ['account_code' => 4000, 'account_name' => 'Revenue Account', 'created_at' => now(), 'updated_at' => now()],
//            ['account_code' => 5000, 'account_name' => 'Expense Accounts', 'created_at' => now(), 'updated_at' => now()],
//            ['account_code' => 1000, 'account_name' => 'Asset Account', 'created_at' => now(), 'updated_at' => now()],
//            ['account_code' => 2000, 'account_name' => 'Liability Accounts', 'created_at' => now(), 'updated_at' => now()],
//            ['account_code' => 3000, 'account_name' => 'Equity Accounts', 'created_at' => now(), 'updated_at' => now()],
//        ]);


        // Get the file path
        $filePath = storage_path('txt/go.txt');

        // Read the contents of the file
        $fileContents = File::get($filePath);


        $lines = explode("\n", $fileContents);


        $majorCategory = '';
        $majorCategoryCode = '';
        $category = '';
        $categoryCode = '';

        foreach ($lines as $line) {


            $letters = trim(preg_replace('/[^A-Za-z\s]/', '', $line));
            $letters = trim(str_replace(' ', '_', $letters));

            preg_match('/\d+/', $line, $match);
            $number = 0000;
            if (!empty($match)) {
                $number = trim($match[0]);

            }


            // Check if there are any letters and if they are all uppercase
            if (!empty($letters) && strtoupper($letters) == $letters) {

                if (strpos($letters, "ACCOUNTS")) {
                    // THIS IS A MAJOR CATEGORY
                    $letters = strtolower(str_replace(' ', '_', $letters));
                    $newAccountData = [
                        'account_code' => $number,
                        'account_name' => $letters,
                    ];

                    $insertedId = DB::table('GL_accounts')->insert($newAccountData);

                    Schema::dropIfExists($letters);
                    Schema::create($letters, function (Blueprint $table) {
                        $table->id()->autoIncrement(); // Makes id column incremental
                        $table->string('major_category_code')->nullable();
                        $table->string('category_code')->nullable();
                        $table->string('category_name')->nullable();
                        $table->timestamps();
                    });

                    $majorCategory = $letters;
                    $majorCategoryCode = $number;


                } else {

                    $letters = strtolower(str_replace(' ', '_', $letters));
                    $newAccountData = [
                        'major_category_code' => $majorCategoryCode,
                        'category_code' => $number,
                        'category_name' => $letters,
                    ];

                    $inserted = DB::table($majorCategory)->insert($newAccountData);

                    Schema::dropIfExists($letters);
                    Schema::create($letters, function (Blueprint $table) {
                        $table->id()->autoIncrement(); // Makes id column incremental
                        $table->string('category_code')->nullable();
                        $table->string('sub_category_code')->nullable();
                        $table->string('sub_category_name')->nullable();
                        $table->timestamps();
                    });

                    $category = $letters;
                    $categoryCode = $number;
                }

            } elseif (!empty($letters)) {

                $letters = strtolower(str_replace(' ', '_', $letters));
                $newAccountData = [
                    'category_code' => $categoryCode,
                    'sub_category_code' => $number,
                    'sub_category_name' => $letters,
                ];

                $inserted = DB::table($category)->insert($newAccountData);


                // Replace underscores with spaces
                $letters = str_replace('_', ' ', $letters);

                // Change the first letter of each word to uppercase
                $letters = ucwords($letters);

                $id2 = AccountsModel::create([
                    'account_use' => 'internal',
                    'institution_number' => auth()->user()->institution_id,
                    'branch_number' => auth()->user()->branch,
                    'client_number' => '0000',
                    'product_number' => '',
                    'sub_product_number' => '',
                    'major_category_code' => $majorCategoryCode,
                    'category_code' => $categoryCode,
                    'sub_category_code' => $number,
                    'account_name' => $letters,
                    'account_number' => str_pad(auth()->user()->institution_id, 2, 0, STR_PAD_LEFT) . '' . str_pad(auth()->user()->branch, 2, 0, STR_PAD_LEFT) . '0000' . $number,
                    'notes' => "  ",

                ])->id;


            }

            else {
                echo "No letters found in the string.";
            }


        }
    }
}
