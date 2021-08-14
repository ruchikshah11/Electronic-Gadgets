@extends('backEnd.layouts.master')
@section('title','List Orders')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('coupon.index')}}" class="current">Orders</a></div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>List Orderss</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table" id="example">
                    <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <!-- <th>User Name</th> -->
                        <th>Sr No.</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Pincode</th>
                        <th>Mobile</th>
                        <th>Order Status</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Payment Method</th>
                        <th>Order Date /Time </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; ?>
                    @foreach($orders as $coupon)
                        <?php $i++; ?>
                        <tr class="gradeC">
                            <td>{{$i}}</td>
                            <!-- <td style="vertical-align: middle;">{{$coupon->coupon_code}}</td> -->
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->users_email}} </td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->name}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->address}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->pincode}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->mobile}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->order_status}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->coupon_amount}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->grand_total}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->payment_method}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$coupon->created_at}}</td>
                           
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="{{asset('js/matrix.popover.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(".deleteRecord").click(function () {
            var id=$(this).attr('rel');
            var deleteFunction=$(this).attr('rel1');
            swal({
                title:'Are you sure?',
                text:"You won't be able to revert this!",
                type:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes, delete it!',
                cancelButtonText:'No, cancel!',
                confirmButtonClass:'btn btn-success',
                cancelButtonClass:'btn btn-danger',
                buttonsStyling:false,
                reverseButtons:true
            },function () {
                window.location.href="/admin/"+deleteFunction+"/"+id;
            });
        });
    </script>
	 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
        $('#example').DataTable( {

            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                 {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'print',
                    text: 'Print all ',
                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                },
                {
                 text: 'TSV',
                    extend: 'csvHtml5',
                    fieldSeparator: '\t',
                    extension: '.tsv'

                },


                {
                    text: 'JSON',
                    action: function ( e, dt, button, config ) {
                        var data = dt.buttons.exportData();

                        $.fn.dataTable.fileSave(
                            new Blob( [ JSON.stringify( data ) ] ),
                            'Export.json'
                        );
                    }
                },

                'colvis',

            ],
        } );
    } );
    </script>
@endsection