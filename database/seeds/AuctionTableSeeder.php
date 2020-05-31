<?php

use App\Auction;
use App\Bid;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Auction::class, 50)->create()->each(function (Auction $auction) {
            $cats = Category::all()->random(rand()%4);
            foreach ($cats as $cat) {
                DB::table('auction_category')->insert([
                    'auction_id' => $auction->id,
                    'cat_id' => $cat->id
                ]);
            }

            $owner = $auction->owner;
            $last = DB::table('bazooker')->whereNotIn('id', [$owner])->inRandomOrder()->first();

            $current_time = $auction->start_time;
            $add_seconds = 10 + (rand() % (3600 * 10));
            $current_time->modify("+ $add_seconds seconds");

            $end_time = $auction->endDateTime();
            $now = new DateTime('now');

            $current_price = $auction->currentPrice();
            while($current_time < $end_time && $current_time < $now) {
                $new_amount = $current_price + 1 + (rand()%50);

                DB::table('bid')->insert([
                    'auction_id' => $auction->id,
                    'bidder_id' => $last->id,
                    'amount' => $new_amount,
                    'time' => $current_time,
                ]);

                $add_seconds = 10 + (rand() % (3600 * 10));
                $current_time->modify("+ $add_seconds seconds");
                $current_price = $new_amount;
                $last = DB::table('bazooker')->whereNotIn('id', [$owner, $last->id])->inRandomOrder()->first();
            }
        });
    }
}
