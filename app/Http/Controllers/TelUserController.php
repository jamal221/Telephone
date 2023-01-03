<?php

namespace App\Http\Controllers;

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
        try {
            if ($request->ajax()) {
                //$data = DB::table('weblinks')->orderBy('id','desc')->get();
                $username1 = $request->user1;
                $password1 = $request->pass1;

                $data3 = DB::table('users')
                    ->select('*')
                    ->where('Emd_id', '=', $username1)
                    ->where('password', '=', $password1)
                    ->count();
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
        $data_user = $this->getUserwithoutTrashedPaginated();
        $data_user_all = $this->getUserwithoutTrashedAll();
//        echo "Find ID successfuly ";
        return view('Login.AdminLTE', compact('data_user', 'data_user_all'));
//    redirect('Login.AdminLTE');
    }

    public function Deleted_Mobile_users()
    {
//    $data_user=User::get();
        $data_user = $this->getUserTrashedPaginated();
        $data_user_all = $this->getUserTrashedAll();
//        echo "Find ID successfuly ";
        return view('Results.Deleted_User', compact('data_user', 'data_user_all'));
//    redirect('Login.AdminLTE');
    }

    public function restore_user(Request $request)
    {
//    $data_user=User::get();
        $id = $request->id;
        $restore_mobile = $this->restoreDeletedMobile($id);//db part
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
        $user_emp_id = $request->emp_id;
        $data_user = DB::table('users')
            ->select('*')
            ->where('Emd_id', '=', $user_emp_id)
            ->paginate('25');


        return view('Results.usershowByPrs', compact('data_user'));
//    redirect('Login.AdminLTE');
    }

    public function FilterUser()
    {
        $data_user = DB::table('users')
            ->select('*')
            ->paginate('20');

        return view('Results.user_management', compact('data_user'));
    }

    public function destroy($id)
    {
        //User::find($id)->delete($id);
//        DB::table('user_msg')
//            ->where('id', $id)
//            ->delete();
        $del_mobile = User::where('id', $id)->delete();// by the way the deleted_at generated in mysql
        if ($del_mobile) {
            return response()->json([
                'success' => 'حذف با موفقیت صورت گرفت!'
            ]);
        }

    }

    public function destroyForce($id)
    {
        $del_mobile_force = User::withTrashed()->where('id', $id)->forceDelete();// by the way the deleted_at generated in mysql
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
            $user_mobile_new = $request->new_mobile;
            $time2 = time();
            //$time2=jdate('Y/n/j H:i:s');
            //$time2="123456789";
            try {
                // Validate the value...
                $update_mobile_user = User::where('id', $request->id_ajax)// in this part I used to user_msg model for query
                ->update(['mobile' => $user_mobile_new]);
//                if(DB::table('user_msg')
//                    ->where('id', $request->id_ajax)
//                    ->update(['msg_response'=>$msg_admin1, 'date_response'=>$time2]))
                if ($update_mobile_user) {
                    echo '<div class="alert alert-success">آپدیت موفقیت آمیز بود.</div>';
//                    return "ok";// for testing code by postman

                } else {
                    echo '<div class="alert alert-danger">مشکلی در بروز رسانی رخ داده است</div>';
//                    return "not okay";// for test code by postman
                }
            } catch (Exception $e) {
                echo '<div class="alert alert-success">error exist in your code</div>';
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

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getUserwithoutTrashedPaginated()// Design pattern , Solid(1)
    {
        $data_user = User::withoutTrashed()
            ->paginate('20');
        return $data_user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    private function getUserwithoutTrashedAll()// Design pattern , Solid(1)
    {
        $data_user_all = User::withoutTrashed()
            ->get();
        return $data_user_all;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getUserTrashedPaginated()// Design pattern , Solid(1)
    {
        $data_user = User::onlyTrashed()
            ->paginate('20');
        return $data_user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    private function getUserTrashedAll()// Design pattern , Solid(1)
    {
        $data_user_all = User::onlyTrashed()
            ->get();
        return $data_user_all;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function restoreDeletedMobile($id)// Design pattern , Solid(1)
    {
        $restore_mobile = $this->getUserTrashedAll()->find($id)->restore();
        return $restore_mobile;
    }

    /**
     * @param $user_emp_id
     * @return mixed
     */


}
