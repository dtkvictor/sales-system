<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Sale;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SaleFactory extends Factory
{

    public function getUser()
    {
        $user = User::all();
        if($user->isEmpty()) return null;
        return ($user->random())->id;
    }

    public function getClient()
    {
        $client = Client::all();
        if($client->isEmpty()) return null;
        return ($client->random())->id;
    }

    public function getPaymentMethod()
    {
        return Sale::paymentMethod()[rand(0,1)]; 
    }

    public function getOptionParcels()
    {
        return Sale::optionParcels()[rand(0, 12)];
    }
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->getUser(),
            'client_id' => $this->getClient(),
            'payment_method' => $this->getPaymentMethod(),
            'parcels' => $this->getOptionParcels(),
        ];
    }
}
