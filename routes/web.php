<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Reservation;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/wait',function(){
    return view('TurFirma.html.wait');
});

Route::get('/tour',function(Request $request){
    $turId = $request->get('turId');
    $numPeople = $request->get('numPeople');
    $tur = DB::table('tur')->where('id',$turId)->get();
    //dd($tur);
    $city = DB::table('city')->where('id',$tur[0]->id_city)->get();
    $country = DB::table('country')->where('id',$city[0]->country_id)->get();
    $hotel = DB::table('hotel')->where('id',$tur[0]->id_hotel)->get();
    $rooms = DB::table('room')->where('id_hotel',$hotel[0]->id)->get();
    $dopServices = DB::table('dop_services')->where('id_tur',$tur[0]->id)->get();
    $transport = DB::table('transport')->where('id_tur',$tur[0]->id)->get();

    return view('TurFirma.html.tour',[
        'tur'=>$tur[0],
        'city'=>$city[0],
        'country'=>$country[0],
        'hotel'=>$hotel[0],
        'rooms'=>$rooms,
        'dopServices'=>$dopServices,
        'transport'=>$transport[0],
        'numPeople'=>$numPeople
    ]);
})->name('tour');

Route::post('/reservation',function(Request $request){
    $tour = $request->get('tour');
    $sum = $request->get('sum');
    $date = $request->get('date');
    $duration = $request->get('duration');
    $numPeople = $request->get('numPeople');
    $services = $request->get('services');
    $idStatus = DB::table('status')->where('id',1)->get();
    $userId = Auth::user()->id;
    Reservation::create([
        'id_tur'=>$tour,
        'id_status'=>$idStatus[0]->id,
        'summ'=>$sum,
        'date_start'=>$date,
        'duration'=>$duration,
        'num_people'=>$numPeople,
        'id_user'=>$userId,
        'services'=>$services
    ]);

});

Route::get('/', function () {
    $popular_tur = DB::table('tur')->where('rate','>=',90)->get();
    $res = [];
    $allCity = DB::table('city')->get();
    foreach($popular_tur as $tur){
   
       $countryId = DB::table('city')->where('id',$tur->id_city)->get();
       $countryName = DB::table('country')->where('id',$countryId[0]->id)->get();
       $arr = array('tur'=>$tur,'country'=>$countryName[0]);
       array_push($res,$arr);    
    }
    return view('turFirma.html.main',['popular'=>$res,'allCity'=>$allCity]);
})->name('main');

Route::post('/getAllTurs',function(){
    $all_tur = DB::table('tur')->get();
    $res = [];
    if(Auth::check()){
        $userId = Auth::user()->id;
    
        foreach($all_tur as $tur){
            $favorite_tur = DB::table('favorite_tur')->where([
                ['id_tur',$tur->id],
                ['id_user',$userId]
            ])->get();    
            $hotel = DB::table('hotel')->where('id',$tur->id_hotel)->get();
            $countryId = DB::table('city')->where('id',$tur->id_city)->get();
            $countryName = DB::table('country')->where('id',$countryId[0]->id)->get();
            $arr = array('tur'=>$tur,'city'=>$countryId[0],'country'=>$countryName[0],'hotel'=>$hotel[0],'favorite'=>$favorite_tur);
            array_push($res,$arr);   
             
         }
        } else {
            foreach($all_tur as $tur){
                $favorite_tur = 'not auth';   
                $hotel = DB::table('hotel')->where('id',$tur->id_hotel)->get();
                $countryId = DB::table('city')->where('id',$tur->id_city)->get();
                $countryName = DB::table('country')->where('id',$countryId[0]->id)->get();
                $arr = array('tur'=>$tur,'city'=>$countryId[0],'country'=>$countryName[0],'hotel'=>$hotel[0],'favorite'=>$favorite_tur);
                array_push($res,$arr);   
                 
             }
        }
     return response()->json(['turs'=>$res]);
});

Route::post('/changePhotoUser',function(Request $request){
   $img = $request->file('image')->store('uploads','public');
   $img= '/storage/'.$img;
   $user = User::find(Auth::user()->id);
   $user->photo = $img;
   $user->save();
   return redirect()->route('profileUser');

});

Route::post('/delPhoto',function(){
    $user = User::find(Auth::user()->id);
    $user->photo = '';
    $user->save();
    return redirect()->route('profileUser');
});

Route::post('/delPasport',function(){
    $user = User::find(Auth::user()->id);
    $user->series_number_pasport = null;
    $user->date_issue_pasport = null;
    $user->kod_department = null;
    $user->who_issued_pasport = null;
    $user->save();
});

Route::post('/delInternational',function(){
    $user = User::find(Auth::user()->id);
    $user->international_series_number = null;
    $user->international_date = null;
    $user->international_end = null;
    $user->who_issued_international = null;
    $user->save();
});

Route::get('/profileUser', function () {
    $authUser = Auth::user();
    $reservations = DB::table('reservation')->where('id_user',$authUser->id)->get();

    $favorite_tur = DB::table('favorite_tur')->where('id_user',$authUser->id)->get();
    $favoriteAll = [];
    foreach($favorite_tur as $favorite){
        $tur = DB::table('tur')->where('id',$favorite->id_tur)->get();
        
        array_push($favoriteAll,$tur[0]);
    }
    
    $res = [];
    foreach($reservations as $reservation){
        $tur = DB::table('tur')->where('id',$reservation->id_tur)->get();
        $status = DB::table('status')->where('id',$reservation->id_status)->get();
        $services = explode(',', $reservation->services);
        $serviceArr = [];
        foreach($services as $service){
            $s = DB::table('dop_services')->where('id',$service)->get();
            array_push($serviceArr,$s[0]);
        }
        $arr = array('tur'=>$tur[0],'status'=>$status[0],'reservation'=>$reservation,
        'services'=>$serviceArr
    );
     array_push($res,$arr);
        
    }
    return view('turFirma.html.profile',[
        'auth'=>$authUser,
        'reservation'=>$res,
        'favoriteAll'=>$favoriteAll
    ]);
})->name('profileUser');

Route::post('/changePersonalInfo',function(Request $request){
    $surname = $request->get('surname');
    $name = $request->get('name');
    $patronomic = $request->get('patronomic');
    $birthday = $request->get('birthday');
    $gender = $request->get('gender');
    $user =  User::find(Auth::user()->id);
    $user->name = $name;
    $user->surname = $surname;
    $user->patronomic = $patronomic;
    $user->birthday = $birthday;
    $user->gender = $gender;
    $user->save();
});

Route::post('/changePasport',function(Request $request){
    $seriesAndNumber = $request->get('seriesAndNumber');
    $datePasport = $request->get('datePasport');
    $kodDepartment = $request->get('kodDepartment');
    $pasportWho = $request->get('pasportWho');
    $user = User::find(Auth::user()->id);
    $user->series_number_pasport = $seriesAndNumber;
    $user->date_issue_pasport = $datePasport;
    $user->kod_department = $kodDepartment;
    $user->who_issued_pasport = $pasportWho;
    $user->save();
});

Route::post('/changeIntertnational',function(Request $request){
    $internationalPasport = $request->get('internationalPasport');
    $internationalDate = $request->get('internationalDate');
    $internationalEnd = $request->get('internationalEnd');
    $internationalWho = $request->get('internationalWho');
    $user = User::find(Auth::user()->id);
    $user->international_series_number = $internationalPasport;
    $user->international_date = $internationalDate;
    $user->international_end = $internationalEnd;
    $user->who_issued_international = $internationalWho;
    $user->save();
});

Route::post('/getUser',function(){
    $user = Auth::user();
    return response()->json(['user'=>$user]);
});

Route::get('/registration', function () {
    return view('turFirma.html.registration');
})->name('registration');

Route::get('/turpackeges', function () {
    $all_tur = DB::table('tur')->get();
    $res = [];
    if(Auth::check()){
    $userId = Auth::user()->id;

    foreach($all_tur as $tur){
        $favorite_tur = DB::table('favorite_tur')->where([
            ['id_tur',$tur->id],
            ['id_user',$userId]
        ])->get();    
        $hotel = DB::table('hotel')->where('id',$tur->id_hotel)->get();
        $countryId = DB::table('city')->where('id',$tur->id_city)->get();
        $countryName = DB::table('country')->where('id',$countryId[0]->id)->get();
        $arr = array('tur'=>$tur,'city'=>$countryId[0],'country'=>$countryName[0],'hotel'=>$hotel[0],'favorite'=>$favorite_tur);
        array_push($res,$arr);   
         
     }
    } else {
        foreach($all_tur as $tur){
            $favorite_tur = 'not auth';   
            $hotel = DB::table('hotel')->where('id',$tur->id_hotel)->get();
            $countryId = DB::table('city')->where('id',$tur->id_city)->get();
            $countryName = DB::table('country')->where('id',$countryId[0]->id)->get();
            $arr = array('tur'=>$tur,'city'=>$countryId[0],'country'=>$countryName[0],'hotel'=>$hotel[0],'favorite'=>$favorite_tur);
            array_push($res,$arr);   
             
         }
    }
    return view('turFirma.html.turpackeges',['turs'=>$res]);
})->name('turpackeges');


Route::post('/createUser',function(Request $request){
   $user = User::create([
        'name'=>$request->get('name'),
        'surname'=>$request->get('surname'),
        'number'=>$request->get('number'),
        'email'=>$request->get('email'),
        'password'=>Hash::make($request->get('password'))
    ]);
    auth()->login($user);
    return redirect()->route('main');
});

Route::post('/favoriteTurAdd',function(Request $request){
    $turId = $request->get('tur');
    $userId = Auth::user()->id;
    Favorite::create([
        'id_tur'=>$turId,
        'id_user'=>$userId
    ]);
});

Route::post('/favoriteTurDel',function(Request $request){
    $turId = $request->get('tur');
    $userId = Auth::user()->id;
    Favorite::where([
        ['id_tur',$turId],
        ['id_user',$userId]
    ])->delete();
});

Route::post('/filterTurs',function(Request $request){

    $numPeople = (int) $request->get('numPeople');

    $duration =(int) $request->get('duration');

    $priceStart = (int) $request->get('priceStart');

    $priceEnd =(int) $request->get('priceEnd');

    if($priceEnd!=null && $priceEnd!=null){
        $result = DB::table('tur')->where([
            ['num_people','>=',$numPeople],
            ['duration',$duration],
            // ['id_city',$city[0]->id],
            ['price','>=',$priceStart],
            ['price','<=',$priceEnd],
        ])->get();

    } elseif($priceEnd!=null && $priceStart==null){
        $result = DB::table('tur')->where([
            ['num_people','>=',$numPeople],
            ['duration',$duration],
            // ['id_city',$city[0]->id],
            ['price','<=',$priceEnd],
        ])->get();
    } elseif($priceStart!=null && $priceEnd==null){
        $result = DB::table('tur')->where([
            ['num_people','>=',$numPeople],
            ['duration',$duration],
            // ['id_city',$city[0]->id],
            ['price','>=',$priceStart],
        ])->get();
    } else {
        $result = DB::table('tur')->where([
            ['num_people','>=',$numPeople],
            ['duration',$duration],
            // ['id_city',$city[0]->id],
        ])->get();
    }
    
    $res = [];

    if(Auth::check()){
        $userId = Auth::user()->id;
    
        foreach($result as $tur){
            $favorite_tur = DB::table('favorite_tur')->where([
                ['id_tur',$tur->id],
                ['id_user',$userId]
            ])->get();    
            $hotel = DB::table('hotel')->where('id',$tur->id_hotel)->get();
            $countryId = DB::table('city')->where('id',$tur->id_city)->get();
            $countryName = DB::table('country')->where('id',$countryId[0]->id)->get();
            $arr = array('tur'=>$tur,'city'=>$countryId[0],'country'=>$countryName[0],'hotel'=>$hotel[0],'favorite'=>$favorite_tur);
            array_push($res,$arr);   
             
         }
        } else {
            foreach($result as $tur){
                $favorite_tur = 'not auth';   
                $hotel = DB::table('hotel')->where('id',$tur->id_hotel)->get();
                $countryId = DB::table('city')->where('id',$tur->id_city)->get();
                $countryName = DB::table('country')->where('id',$countryId[0]->id)->get();
                $arr = array('tur'=>$tur,'city'=>$countryId[0],'country'=>$countryName[0],'hotel'=>$hotel[0],'favorite'=>$favorite_tur);
                array_push($res,$arr);   
                 
             }
        }
    return response()->json(['turs'=>$res]);
});

Route::post('/changePassword',function(Request $request){
    $oldPassword = $request->get('passwordUser');
    $newPassword = $request->get('passwordNew');
    if(Hash::check($oldPassword,Auth::user()->password)){
        $user =  User::find(Auth::user()->id);
        $user->password = Hash::make($newPassword);
        $user->save();
        return response()->json(['status'=>'true']);
    } else {
        return response()->json(['status'=>'false']);
    }
});

Route::post('/changeNumber',function(Request $request){
    $number = $request->get('number');
    $dopNumber = $request->get('dopNumber');
    
    $user =  User::find(Auth::user()->id);
    $user->number = $number;
    $user->dop_number = $dopNumber;
    $user->save();
});

Route::post('/changeEmail',function(Request $request){
    $email = $request->get('email');

    $user =  User::find(Auth::user()->id);
    $user->email = $email;
    $user->save();

});

Route::get('/dashboard', function () {
    return redirect()->route('main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
