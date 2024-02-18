<?php

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $parentId = null;

        $entitiesCount = Entity::query()->count();

        if($entitiesCount > 10 && rand(0 , 1) > 0) {
            $parentId = Entity::query()->whereNull('parent_id')->inRandomOrder()->first()->id;
        }

//        dd($entitiesCount, rand(0 , 1) > 0, $parentId, Entity::query()->whereNull('parent_id')->inRandomOrder()->first()->id);

        return [
            'title' => $this->faker->userName,
            'parent_id' => $parentId
        ];
    }
}
