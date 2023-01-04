<?php

namespace App\Http\Controllers;

use App\DB\TepRepo;
use App\Imports\UsersImport;
use App\Models\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportUser;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\SendNotification;
use \App\Notifications\TelegramNotification;
use Illuminate\Notifications\Notifiable;

class TelUserController extends Controller
{
    //
    public function index(Request $request)
    {
        return "Welcome to TelUser Project";
    }

    public function CheckUser(Request $request)
    {
        $telFunctionClasses=resolve(TepRepo::class);
        try {
            if ($request->ajax()) {
                //$data = DB::table('weblinks')->orderBy('id','desc')->get();
                $username1 = $request->user1;
                $password1 = $request->pass1;

                $data3 = $telFunctionClasses->UserCheckCount($username1, $password1);
                //->paginate(30);
                //echo $data3;

                if ($data3 == 1) {
//                    Cache::store('database')->add('user_valid', $username1, now()->addMinutes(20));// equal 20 minutes
//                    Cache::lock('user_valid');
//                    $request->session()->put("user_valid", $username1);
                    echo 123;
                } else {
                    echo 321;
                }

                //echo "123";
            } else {
                echo " no in db";
            }
        } catch (Exception $e) {
            echo "db error";

        }
    }

    public function exportUsers(Request $request)
    {
//        $headers_Users=['Personnel_ID', 'Mobile_User','Name_User','Family_User'];
        return Excel::download(new ExportUser, 'User_Excell.xlsx');
    }

    public function fileImport(Request $request)
    {
//        dd($request->file('file'));
        User::truncate();
        Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return back();
//        try{
//            DB::beginTransaction();
//
//            if(Excel::import(new UsersImport, $request->file('file')->store('temp')))
//                echo '<div class="alert alert-success">Data Deleted</div>';
//                DB:: commit();
//        }
//        catch (\Exception $e)
//        {
//            DB::rollBack();
//            echo '<div class="alert alert-danger">Error accured </div>';
//            Log::error($e);
//            throw $e;
//        }

//        return back();
    }

    public function adminLTE()
    {
//    $data_user=User::get();
        $telFunctionClasses=resolve(TepRepo::class);
        $data_user = $telFunctionClasses->getUserwithoutTrashedPaginated();
        $data_user_all = $telFunctionClasses->getUserwithoutTrashedAll();
//        echo "Find ID successfuly ";
        return view('Login.AdminLTE', compact('data_user', 'data_user_all'));
//    redirect('Login.AdminLTE');
    }

    public function Deleted_Mobile_users()
    {
//    $data_user=User::get();
        $telFunctionClasses=resolve(TepRepo::class);
        $data_user = $telFunctionClasses->getUserTrashedPaginated();
        $data_user_all = $telFunctionClasses->getUserTrashedAll();
//        echo "Find ID successfuly ";
        return view('Results.Deleted_User', compact('data_user', 'data_user_all'));
//    redirect('Login.AdminLTE');
    }

    public function restore_user(Request $request)
    {
//    $data_user=User::get();
        $id = $request->id;
        $telFunctionClasses=resolve(TepRepo::class);
        $restore_mobile = $telFunctionClasses->restoreDeletedMobile($id);//db part
        if ($restore_mobile) {// http response
            return response()->json([
                'success' => 'بازنشانی باموفقیت صورت گرفت'
            ]);
        }
//    redirect('Login.AdminLTE');
    }

    public function prs_search(Request $request)
    {
//    $data_user=User::get();
        $telFunctionClasses=resolve(TepRepo::class);

        $user_emp_id = $request->emp_id;
        $data_user = $telFunctionClasses->UserSearchBasedEmpID($user_emp_id);


        return view('Results.usershowByPrs', compact('data_user'));
//    redirect('Login.AdminLTE');
    }

    public function FilterUser()
    {
        $page=20;
        $telFunctionClasses=resolve(TepRepo::class);
        $data_user = $telFunctionClasses->getUserAllPaginate($page);

        return view('Results.user_management', compact('data_user'));
    }

    public function destroy($id)
    {

        $telFunctionClasses=resolve(TepRepo::class);
        $del_mobile = $telFunctionClasses->UserDeleteBasedID($id);// by the way the deleted_at generated in mysql
        if ($del_mobile) {
            return response()->json([
                'success' => 'حذف با موفقیت صورت گرفت!'
            ]);
        }

    }

    public function destroyForce($id)
    {
        $telFunctionClasses=resolve(TepRepo::class);
        $del_mobile_force = $telFunctionClasses->UserForceDeleteByID($id);// by the way the deleted_at generated in mysql
        if ($del_mobile_force) {
            return response()->json([
                'success' => 'موبایل به طور کامل از دیتا بیس حذف گردید.'
            ]);
        }
    }

    public function Update_mobile(Request $request)

    {
// The below code used for postman testing
        /*$time2=time();
        $msg_update=DB::table('user_msg')
            ->where('id', $request->id_ajax)
            ->update(['msg_response'=>$request->msg_admin, 'date_response'=>$time2]);
        dd($msg_update);*/

        //if($request->ajax())
        if ($request->ajax()) {
            $telFunctionClasses=resolve(TepRepo::class);
            $user_mobile_new = $request->new_mobile;
            $id_user=$request->id_ajax;
            $time2 = time();
            //$time2=jdate('Y/n/j H:i:s');
            //$time2="123456789";
            try {
                // Validate the value...
                $update_mobile_user = $telFunctionClasses->UserUpdateMobile($id_user,$user_mobile_new);//Use Design pattern and The first principal of Solid
                if ($update_mobile_user) {
                    echo '<div class="alert alert-success">آپدیت موفقیت آمیز بود.</div>';
//                    return "ok";// for testing code by postman

                } else {
                    echo '<div class="alert alert-danger">مشکلی در بروز رسانی رخ داده است</div>';
//                    return "not okay";// for test code by postman
                }
            } catch (Exception $e) {
                echo '<div class="alert alert-success">error exist in your code</div>';
                Log::log($e);
                //consloe.log($ex->getMessage());
                //dd($e->getMessage());
                //return false;
            }


            //$link_type=$request->link_type_ajax;
        }
    }


    public function telegram()
    {
        // the below code illustrated sending message to telegram by Api telegram
//        $your_msg="salammmmmmm";
//        $telegram_id=-1001697621903;
//        return redirect()->away('https://api.telegram.org/bot5968125646:AAFsZzESOYaZELcvjXyG-FORZ9V8Km0xdzk/sendMessage?chat_id='. $telegram_id.'&text='.$your_msg);
          return notify(new TelegramNotification());
//            return (new TelegramNotification());
    }


}
