<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\CoreBranch;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoreBranch>
 */
class CoreBranchFactory extends Factory
{

    protected $model = CoreBranch::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $faker = \Faker\Factory::create();

        return [
            'branch_code' => $faker->unique()->regexify('[A-Za-z0-9]{6}'),
            'branch_name' => $faker->company,
            'branch_manager' => $faker->name,
            'branch_address' => $faker->address,
            'branch_city' => $faker->city,
            'branch_contact_person' => $faker->name,
            'branch_email' => $faker->email,
            'branch_phone1' => $faker->phoneNumber,
            'account_rak_id' => $faker->numberBetween(0, 10),
            'account_aka_id' => $faker->numberBetween(0, 10),
            'account_capital_id' => $faker->numberBetween(0, 10),
            'branch_has_child' => $faker->numberBetween(0, 1),
            'branch_top_parent_id' => $faker->numberBetween(0, 1),
            'branch_parent_id' => $faker->numberBetween(0, 1),
            'branch_status' => $faker->numberBetween(0, 1),
        ];
    }
}
