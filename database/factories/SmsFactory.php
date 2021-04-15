<?php

namespace Database\Factories;

use App\Models\Sms;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SmsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sms::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::all()->random()->id,
            'recipient'=>$this->faker->e164PhoneNumber,
            'message'=>$this->faker->words(15, true),
            'status'=>'unknown',
            'created_at'=>$this->faker->dateTimeBetween('-1 week', 'now'),
            ];
    }
}
