@extends('layouts.AdminLayout')
@section('content')
    <table class="table table-bordered" id="Tel_Table">
        <thead>
        <tr>
            <th>دیف</th>
            <th>شماره پرسنلی</th>
            <th>نام </th>
            <th>نام خانوادگی</th>
            <th>موبایل</th>

            <th width="300px;">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="مشاهده بر اساس شماره پرسنلی..." title="Type in a name">
        @php
            $count_row=1
        @endphp
        @if(!empty($data_user))
            @foreach($data_user as $value)
                <tr>
                    <td  class="column_name" data-column_name="User_Count" data-id={{ $value->id }}>{{ $count_row  }}</td>
                    <td  class="column_name" data-column_name="User_Emp_ID" data-id={{ $value->id }}>{{ $value->Emd_id  }}</td>
                    <td  class="column_name" data-column_name="User_Name" data-id={{ $value->id }}>{{ $value->name }}</td>
                    <td  class="column_name" data-column_name="User_Family" data-id={{ $value->id }}>{{ $value->family }}</td>
                    <td  class="column_name" data-column_name="User_Mobile" data-id={{ $value->id }}>{{ $value->mobile }}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs delete" data-id={{ $value->id }}>حذف</button>
                        <button type="button" class="btn btn-success btn-xs edite" id={{$value->id."_".$count_row}}>بروزرسانی</button>
                    </td>
                </tr>
                @php
                    $count_row+=1
                @endphp

            @endforeach


        @endif
        </tbody>
    </table>
    {{ csrf_field() }}
    <div class="d-flex justify-content-lg-center">
        {{ $data_user->appends(['sort' => 'department'])->links() }}
        {{--                {{ $data->fragment(['sort' => 'department'])->links() }}--}}
    </div>
    <script>
        function myFunction() {
            var emp_id, filter, table, tr, td, i, txtValue;
            emp_id = document.getElementById("myInput").value;
            var _token=$("meta[name='csrf-token']").attr("content");
            // filter = input.value.toUpperCase();
            // table = document.getElementById("Tel_Table");
            // tr = table.getElementsByTagName("tr");
            // for (i = 0; i < tr.length; i++) {
            //     td = tr[i].getElementsByTagName("td")[1];
            //     if (td) {
            //         txtValue = td.textContent || td.innerText;
            //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //             tr[i].style.display = "";
            //         } else {
            //             tr[i].style.display = "none";
            //         }
            //     }
            // }
            console.log({
                "prs_user":emp_id,
                "token":_token

            });
            $.ajax({
                url:"{{ route('prs_search') }}",
                method:"POST",
                data:{prs_user:emp_id,
                    _token:_token
                },
                success: function(data){ // What to do if we succeed
                    $('#message_new').html(data);
                    //$('#div_data').html(data2);
                    // div_header1.style.display="none";
                    // div_header_lte.style.display="none";
                    // div_ribon.style.display="none";
                    //div_header2.style.display="block";
                    //location.reload();
                },
                error: function(data){
                    alert('Error'+data);
                    //console.log(data);
                }
            });
        }
    </script>
@endsection
