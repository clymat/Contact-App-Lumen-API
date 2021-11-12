<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'type' => $this->faker->randomElement(["Client", "Supplier"]),
            'phone' => $this->faker->phoneNumber,
            'occupation' => $this->faker->jobTitle(),
            'business' => $this->faker->company(),
            'address' => $this->faker->address(),

        ];
    }
}
