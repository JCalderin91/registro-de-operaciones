<?php
use App\Operation;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operation::create([
            'description' => 'test',
            'mount' => 4500.2,
            'type' => 1,
        ]);
    }
}
