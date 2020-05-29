<?php

use App\Auction;
use App\Category;
use Illuminate\Database\Seeder;

class AuctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Auction::class, 50)->create()->each(function ($auction) {
            $cats = Category::all()->random(rand()%4);
            foreach ($cats as $cat) {
                DB::table('auction_category')->insert([
                    'auction_id' => $auction->id,
                    'cat_id' => $cat->id
                ]);
            }
        });
    }
}
