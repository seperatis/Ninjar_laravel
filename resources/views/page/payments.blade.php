@extends('layouts.admin')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Sent</th>
                            <th>Address</th>
                            <th>Amount</th>
                            <th>Confirmation</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "dom": 'lrtip',
                "searchable": false,
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                "order": [[ 0, "desc" ]],
                "ajax": {
                    url: "http://luckyblocks.ninja:2052/api/pools/{{ session('id') }}/payments?page=0&pageSize=200",
                    // "url": "http://luckyblocks.ninja:2052/api/pools/ltctestnet/payments?page=0&pageSize=100",
                    "type": "GET",
                    "dataSrc": "",
                },
                "columns": [
                    {"data": null},
                    {"data": 'address'},
                    {"data": null,},
                    {"data": null},
                    {"data": null, "class": "text-center"},
                ],
                "columnDefs": [
                    {
                        "targets": 0,
                        "render": function ( data, type, row, meta ) {
                            var d = new Date();
                            var n = d.getTimezoneOffset();
                            var time = new Date(data.created);
                            time.setMinutes(time.getMinutes() - n);
                            console.log(time);
                            return new Date(time);
                        }
                    },
                    {
                      "targets": 3,
                      "render": function (data, type, row, meta) {
                          string = data.transactionConfirmationData;
                          string = string.substring(0,10) + ' ... ... ' +
                              string.substring(string.length-10, string.length);
                          return string;
                      }
                    },
                    {
                        "targets": 4,
                        "render": function( data, type, row, meta ){
                            return '<a class="btn btn-round btn-sm btn-info" href="'+ data.addressInfoLink +'" target="_blank">To Address</a>' +
                                '<a class="btn btn-round btn-sm btn-primary" href="'+ data.transactionInfoLink +'" target="_blank" style="margin-left: 5px">View Transaction</a>';
                        }
                    },
                    {
                        "targets": 2,
                        "render": function( data, type, row, meta ){
                            var string = data.amount.toFixed(2);
                            console.log(data.amount);
                            return string;
                        }
                    },
                ]

            });
        });
    </script>
    <style>
        .progress-container .progress .progress-bar .progress-value {
            position: absolute;
            top: -3px;
            right: 27px;
            color: #ffffff;
            font-size: 0.62475rem;
        }
    </style>
@endsection