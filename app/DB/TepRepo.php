<?php


namespace App\DB;


use App\Models\User;
use Illuminate\Support\Facades\DB;

class TepRepo
{

    public function getUserwithoutTrashedPaginated()// Design pattern , Solid(1)
    {
        $data_user = User::withoutTrashed()
            ->paginate('20');
        return $data_user;
    }

    public function getUserwithoutTrashedAll()// Design pattern , Solid(1)
    {
        $data_user_all = User::withoutTrashed()
            ->get();
        return $data_user_all;
    }

   public  function getUserTrashedPaginated()// Design pattern , Solid(1)
    {
        $data_user = User::onlyTrashed()
            ->paginate('20');
        return $data_user;
    }

    public function getUserTrashedAll()// Design pattern , Solid(1)
    {
        $data_user_all = User::onlyTrashed()
            ->get();
        return $data_user_all;
    }

    public function restoreDeletedMobile($id)// Design pattern , Solid(1)
    {
        $restore_mobile = $this->getUserTrashedAll()->find($id)->restore();
        return $restore_mobile;
    }

    public function UserCheckCount($username1, $password1)
    {
        $data3 = User::where('Emd_id', '=', $username1)
            ->where('password', '=', $password1)
            ->count();
        return $data3;
    }

    public function UserSearchBasedEmpID($user_emp_id)
    {
        $data_user = User::where('Emd_id',  $user_emp_id)
            ->paginate('25');
        return $data_user;
    }
    public function getUserAllPaginate($page)
    {
        $data_user = User::paginate($page);
        return $data_user;
    }
    public function UserDeleteBasedID($id)
    {
        $del_mobile = User::where('id', $id)->delete();
        return $del_mobile;
    }
    public function UserForceDeleteByID($id)
    {
        $del_mobile_force = User::withTrashed()->where('id', $id)->forceDelete();
        return $del_mobile_force;
    }
    public function UsersearchBasedID($id_user)
    {
        $update_mobile_user = User::where('id', $id_user);
        return $update_mobile_user;
    }
    public function UserUpdateMobile($id_user,$new_mobile)
    {
        $set_mobile_user = $this->UsersearchBasedID($id_user)->update(['mobile' => $new_mobile]);
        return $set_mobile_user;
    }


}
