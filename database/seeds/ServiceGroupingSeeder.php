<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
// Use Models Here
use App\Models\ServiceMatrix\ServiceGroup;

class ServiceGroupingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sg = array(
            array(
                'id' => 1,
                'group_code' => 'SGC-0001',
                'group_description' => 'Bills Payment',
            ),
            array(
                'id' => 2,
                'group_code' => 'SGC-0002',
                'group_description' => 'E-Load',
            ),
            array(
                'id' => 3,
                'group_code' => 'SGC-0003',
                'group_description' => 'Put Money (Cash-In)',
            ),
            array(
                'id' => 4,
                'group_code' => 'SGC-0004',
                'group_description' => 'Get Money (Cash Out)',
            ),
            array(
                'id' => 5,
                'group_code' => 'SGC-0005',
                'group_description' => 'Prefund',
            ),
            array(
                'id' => 6,
                'group_code' => 'SGC-0006',
                'group_description' => 'Auto-Pay',
            ),
            array(
                'id' => 7,
                'group_code' => 'SGC-0007',
                'group_description' => 'Auto-Collect',
            )
        );
        foreach($sg as $data){
            /**
             * @ Create Service Grouping For Default 
             **/
            $ServiceGrouping = ServiceGroup::create([
                    'id' => $data['id'],
                    'group_code' => $data['group_code'],
                    'group_description' => $data['group_description'],
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ]);
        }
    }
}
