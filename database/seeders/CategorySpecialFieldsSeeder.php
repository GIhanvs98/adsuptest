<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySpecialFieldsSeeder extends Seeder
{
    public function run(): void
    {
        // Land
        $this->updateCategory(10, "both");

        // Houses
        $this->updateCategory(11, "both");

        // Apartments
        $this->updateCategory(12, "both");

        // Commercial Property
        $this->updateCategory(1114, "both");

        // Rooms & Annexes
        $this->updateCategory(1115, "rent");

        // Holiday & Short-Term Rental
        $this->updateCategory(1116, "rent");
    }

    private function updateCategory($categoryId, $transactionType): void
    {
        $category = Category::find($categoryId);

        if ($category) {
            $category->update([
                "transaction_type" => $transactionType,
            ]);
        }
    }
}
