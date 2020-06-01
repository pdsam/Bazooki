<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Auction;
use App\AuctionPhoto;
use App\Certification;
use App\Bid;
use Illuminate\Database\QueryException;
use App\Category;
use App\AuctionCategory;

class AuctionController extends Controller
{
     /**
     * Show the form to create a new auction
     *
     * @return View
     */
    public function createForm()
    {
        if(!Auth::check()) {
            return redirect('auctions');
        }

        $categories = Category::all();
        return view('pages.create_auction', ["categories" => $categories]);
    }
    
    public function create(Request $request) {
        if(!Auth::check()) {
            return redirect('auctions');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:2000',
            'short_description' => 'required|string|max:500',
            'base_bid' => 'required|numeric|gte:0',
            'start_time' => 'required|date_format:d-m-Y',
            'duration' => 'required|numeric|gt:0',
            'photos' => 'nullable|array',
            'photos.*' => 'mimes:png,jpg,jpeg,bmp,tiff |max:10240',
            'insta_buy' => 'nullable|numeric|gt:0',
            'certification' => 'nullable|mimes:pdf |max:4096',
            'categories' => 'nullable|array',
            'categories.*' => 'numeric'
        ], $messages = [
            'name.max' => 'Name has a maximum of 100 characters',
            'description.max' => 'Name has a maximum of 2000 characters',
            'short_description.max' => 'Name has a maximum of 500 characters',
            'base_bid.gte' => "Base bid must be greater than or equal to 0",
            'start_time.date_format' => "Invalid date format, must be d-m-Y",
            'duration.gt' => "Duration must be greater than 0",
            'insta_buy.gt' => "Instant buy price must be greater than 0",
            'photos.array' => "Photos must be an array",
            'photos.*.mimes' => 'Photos must be of image format',
            'photos.*.max' => 'Photos must be less than 10 MB',
            'certification.mimes' => 'Certification must be a PDF',
            'certification.max' => 'Certification should be less than 4 MB',
            'categories.array' => "Categories must be an array",
            'categories.*.numeric' => "Categories must be numeric"
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $userID = Auth::user()->id;
        $startDate = date('Y-m-d', strtotime($request->start_time));
        $insta_buy = null;
        if ($request->has('insta_buy')) {
            $insta_buy = $request->insta_buy;
        }
        $newAuction = Auction::create([
            'owner' => $userID,
            'base_bid' => $request->base_bid,
            'start_time' => $startDate,
            'duration' => $request->duration,
            'item_name' => $request->name,
            'item_description' => $request->description,
            'item_short_description' => $request->short_description,
            'insta_buy' => $insta_buy
        ]);

        if(empty($newAuction)) return redirect('auctions');

        if ($request->has('categories')) {
            $categories = $request->categories;
            foreach($categories as $cat) {
                if(Category::where('id', $cat)->exists()) {
                    DB::table('auction_category')->insert([
                        ['auction_id' => $newAuction->id, 'cat_id' => $cat]
                    ]);
                }
            }
        }

        if($request->hasFile('photos')) {
            $files = $request->file('photos');
            foreach($files as $file){
                $filename = $file->store('public/auction_images'); //store image in storage/app/public/auction_images
                AuctionPhoto::create([
                    'auction_id' => $newAuction->id,
                    'image_path' => $filename
                ]);

            }
        }

        if($request->hasFile('certification')) {
            $certification = $request->file('certification');
            $filename = $certification->store('certifications');
            $newCert = Certification::create([
                'auction_id' => $newAuction->id,
                'certification_doc_path' => $filename
            ]);
        }

        return redirect("auctions/$newAuction->id");
    }
    public function show($id = null)
    {
        if($id == null){
            return redirect('auctions');
        }
        $auction = Auction::find($id);
        
        if ($auction == null) {
            return redirect('auctions');
        }

        if ($auction->hasmodAction()) {
            if (!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
                $baz = Auth::guard('bazooker')->user();
                if (is_null($baz)) {
                    return redirect()->route('auctions');
                } else if ($auction->owner != $baz->id) {
                    return redirect()->route('auctions');
                }
            }
        }
        
        $auction_photos = $auction->photos()->get();
        $photo_paths = array();
        foreach($auction_photos as $photo) {
            $path = str_replace("public", "storage", $photo->image_path);
            array_push($photo_paths, $path);
        }

        if (count($photo_paths) == 0) {
            $photo_paths = array("assets/unknown_item.png");
        }

        $categories = $auction->categories()->get();

        return view('pages.auctionPage',[
            'owner' => $auction->owner,
            'id' => $auction->id,
            'name'=>$auction->item_name,
            'base_bid'=>$auction->currentPrice(),
            'description'=>$auction->item_description,
            'duration'=>$auction->duration,
            'start_time'=>$auction->start_time,
            'photos'=>$photo_paths,
            'categories'=>$categories
        ]);

    }

    public function bid(Request $request, $id) {

        $validator = Validator::make($request->all(),[
            'form-id' => 'required|numeric',
            'amount' => 'required|numeric',


        ]);

        try{
        $bid = Bid::create([
            'auction_id'=> $request->input('form-id'),
            'bidder_id'=> Auth::user()->id,
            'amount'=> $request->input('amount'),
        ]);
        }
        catch(QueryException $e){
            abort(403,"Invalid bid");
        }
        


        return response($request->input('amount'));
    }

    public function query(Request $request) {
        $filters = $request->only(['s', 'c', 'm', 'o']);

        $auctionsQuery = Auction::whereRaw('start_time + duration * interval \'1 second\' > CURRENT_TIMESTAMP')
            ->whereDoesntHave('moderatorActions', function (Builder $builder) {
                $builder->where('activate', '=', 'true');
            });
        if (isset($filters['s']) && !empty($filters['s'])) {
            $auctionsQuery = $auctionsQuery->whereRaw('"search" @@ plainto_tsquery(\'english\', ?)', ['\''.$filters['s'].'\'']);
        }

        if (isset($filters['c'])) {
            $constraint = function ($q) use($filters) {
                $q->select('auction_id')
                    ->from('auction_category')
                    ->whereIn('cat_id', $filters['c'])
                    ->groupBy('auction_id')
                    ->havingRaw('count(*) = ?', [count($filters['c'])]);
            };

            $auctionsQuery = $auctionsQuery->whereIn('id', $constraint);
        }

        if (isset($filters['m'])) {
            $auctionsQuery = $auctionsQuery->where('current_price', '<=', $filters['m']);
        }

        if (isset($filters['o'])) {
            switch ($filters['o']) {
                case 'bidDesc':
                    $auctionsQuery->orderBy('current_price', 'desc');
                    break;
                case 'bidAsc':
                    $auctionsQuery->orderBy('current_price', 'asc');
                    break;
                case 'dateEarl':
                    $auctionsQuery->orderByRaw('(start_time + duration * interval \'1 second\') asc');
                    break;
                case 'dateLate':
                    $auctionsQuery->orderByRaw('(start_time + duration * interval \'1 second\') desc');
                    break;
                default:
                    break;
            }
        } else {
            $auctionsQuery->orderBy('current_price', 'asc');
        }

        $pageNum = 0;
        if ($request->exists('p') && is_numeric($request->input('p'))) {
            $pageNum = intval($request->input('p'));
        }

        $pageSize = 10;
        $total = $auctionsQuery->count();

        $offset = 0;
        $num_pages = ceil($total / $pageSize);
        if ($num_pages == 0 || ($num_pages > $pageNum && $pageNum >= 0)) {
            $offset = $pageSize * $pageNum;
        } else {
            $input = $filters;
            $input['p'] = '0';
            return redirect()->route('query', $input);
        }

        $auctions = $auctionsQuery->offset($offset)->limit($pageSize)->get();
        return view('pages.query', [
            'filters'=>$filters,
            'auctions'=>$auctions,
            'current_page' => $pageNum,
            'num_pages'=> $num_pages
        ]);
    }

    public function myAuctions(Request $request) {
        $baz = Auth::guard('bazooker')->user();

        if (is_null($baz)) {
            return redirect()->route('auctions');
        }

        $auctions = $baz->ownAuctions();

        if ($request->exists('o')) {
            switch ($request->input('o')) {
                case 'dateEarl':
                    $auctions->orderByRaw('(start_time + duration * interval \'1 second\') asc');
                    break;
                case 'dateLate':
                    $auctions->orderByRaw('(start_time + duration * interval \'1 second\') desc');
                    break;
                default:
                    break;
            }
        } else {
            $auctions->orderByRaw('(start_time + duration * interval \'1 second\') desc');
        }

        if ($request->exists('f')) {
            switch($request->input('f')) {
                case 'onlyLive':
                    $auctions->whereRaw('start_time + duration * interval \'1 second\' > CURRENT_TIMESTAMP');
                    break;
                case 'onlyOver':
                    $auctions->whereRaw('start_time + duration * interval \'1 second\' < CURRENT_TIMESTAMP');
                    break;
                case 'both':
                default:
                    break;

            }
        }

        $pageNum = 0;
        if ($request->exists('p') && is_numeric($request->input('p'))) {
            $pageNum = intval($request->input('p'));
        }

        $pageSize = 20;
        $total = $auctions->count();

        $offset = 0;
        $num_pages = ceil($total / $pageSize);
        if ($num_pages > $pageNum && $pageNum >= 0) {
            $offset = $pageSize * $pageNum;
        } else {
            return redirect()->route('myauctions', ['p'=>0]);
        }

        $auctions = $auctions->offset($offset)->limit($pageSize)->get();

        return view('pages.activity.myauctions', [
            'auctions' => $auctions,
            'sortOrder'=>$request->input('o'),
            'filter'=>$request->input('f'),
            'current_page' => $pageNum,
            'num_pages'=> $num_pages
            ]);
    }

    public function myBids(Request $request) {
        $baz = Auth::guard('bazooker')->user();

        if (is_null($baz)) {
            return redirect()->route('auctions');
        }

        $bids = $baz->bids();

        if ($request->exists('o')) {
            switch ($request->input('o')) {
                case 'bidDesc':
                    $bids->orderBy('amount', 'desc');
                    break;
                case 'bidAsc':
                    $bids->orderBy('amount', 'asc');
                    break;
                case 'dateEarl':
                    $bids->orderBy('time', 'asc');
                    break;
                case 'dateLate':
                    $bids->orderBy('time', 'desc');
                    break;
                default:
                    break;
            }
        } else {
            $bids->orderBy('time', 'desc');
        }

        if ($request->exists('f')) {
            switch($request->input('f')) {
                case 'onlyLive':
                    $bids->whereHas('auction', function($q) {
                        $q->whereRaw('start_time + duration * interval \'1 second\' > CURRENT_TIMESTAMP');
                    });
                    break;
                case 'onlyOver':
                    $bids->whereHas('auction', function($q) {
                        $q->whereRaw('start_time + duration * interval \'1 second\' < CURRENT_TIMESTAMP');
                    });
                    break;
                case 'both':
                default:
                    break;

            }
        }

        $pageNum = 0;
        if ($request->exists('p') && is_numeric($request->input('p'))) {
            $pageNum = intval($request->input('p'));
        }

        $pageSize = 20;
        $total = $bids->count();

        $offset = 0;
        $num_pages = ceil($total / $pageSize);
        if ($num_pages > $pageNum && $pageNum >= 0) {
            $offset = $pageSize * $pageNum;
        } else {
            return redirect()->route('mybids', ['p'=>0]);
        }

        $bids = $bids->offset($offset)->limit($pageSize)->get();

        return view('pages.activity.mybids', [
            'bids' => $bids,
            'sortOrder'=>$request->input('o'),
            'filter'=>$request->input('f'),
            'current_page' => $pageNum,
            'num_pages'=> $num_pages
        ]);
    }
    //TODO bids
    //TODO won auctions
    //TODO transactions
}
