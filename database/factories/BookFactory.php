<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_buku' => strtoupper(Str::random(6)), // Kode unik max 6 karakter
            'nama_buku' => $this->faker->word(),
            'penulis' => $this->faker->name(),
            'penerbit' => $this->faker->company(),
            'isbn' => $this->faker->randomNumber(9, true), // ISBN biasanya 10 atau 13 digit
            'kategori' => $this->faker->randomElement(['novel', 'cerita-anak', 'manga', 'lainnya']),
            'stock' => $this->faker->numberBetween(1, 100),
            'deskripsi' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['tersedia', 'rusak', 'dipinjam']),
        ];
    }
}
