<?php


namespace App\DB;


use App\Models\User;

class TepRepo
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserwithoutTrashedPaginated()// Design pattern , Solid(1)
    {
        $data_user = User::withoutTrashed()
            ->paginate('20');
        return $data_user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getUserwithoutTrashedAll()// Design pattern , Solid(1)
    {
        $data_user_all = User::withoutTrashed()
            ->get();
        return $data_user_all;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
   public  function getUserTrashedPaginated()// Design pattern , Solid(1)
    {
        $data_user = User::onlyTrashed()
            ->paginate('20');
        return $data_user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getUserTrashedAll()// Design pattern , Solid(1)
    {
        $data_user_all = User::onlyTrashed()
            ->get();
        return $data_user_all;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restoreDeletedMobile($id)// Design pattern , Solid(1)
    {
        $restore_mobile = $this->getUserTrashedAll()->find($id)->restore();
        return $restore_mobile;
    }

    /**
     * @param $user_emp_id
     * @return mixed
     */


}
