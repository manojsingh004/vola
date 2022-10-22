<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $csv_data =array();
        $user = UserProfile::distinct()->get(['city']);
        $user_city =$user->pluck('city')->toArray();

        foreach($user_city as $city){
            $temp=array();
            $user_by_city = UserProfile::select('userId')->where('city',$city)->get();
            $user_id_list =$user_by_city->pluck('userId')->toArray();
            $user_isActiveOrNot = User::whereIn('id',$user_id_list)->get();
           $user_active =  $user_isActiveOrNot->where('isActive',1)->count();
           $user_not_active =  $user_isActiveOrNot->where('isActive',0)->count();
           $temp['city']=$city;
           $temp['activeCount']= $user_active;
           $temp['inactiveCount']=$user_not_active;



           array_push($csv_data,$temp);

        }
        $data = $this->csv($csv_data);



        return response()->json( $data );


    }

    public function csv($csv_data){
        $fileName = 'CSV_Report';
        $path = storage_path('app/public/');


        $columns = array('city','activeCount','inactiveCount');
        $file = fopen($path.$fileName.'.csv', 'w');
        fputcsv($file, $columns);
        foreach($csv_data as $value) {
            fputcsv($file, array($value['city'] ,$value['activeCount'],$value['inactiveCount']));
        }
        fclose($file);
        return array('path'=>$path.$fileName,'filename'=>$fileName );

    }



}
