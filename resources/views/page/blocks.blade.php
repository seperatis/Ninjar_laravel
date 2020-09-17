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
                            <th>Found</th>
                            <th>Miner</th>
                            <th>Height</th>
                            <th>Effort</th>
                            <th>Status</th>
                            <th>Reward</th>
                            <th class="text-center">Confirmation</th>
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
                    url: "http://luckyblocks.ninja:2052/api/pools/{{ session('id') }}/blocks?page=0&pageSize=200",
                    // "url": "http://luckyblocks.ninja:2052/api/pools/ltctestnet/blocks?page=0&pageSize=200",
                    "type": "GET",
                    "dataSrc": "",
                },
                "columns": [
                    {"data": null},
                    {"data": "miner"},
                    {"data": 'blockHeight'},
                    {"data": null, "class": "text-center"},
                    {"data": null},
                    {"data": 'reward'},
                    {"data": null},
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
                        "render": function ( data, type, row, meta ) {
                            var string = '';
                            if (data.effort === null){
                                string = '0%';
                                content = '<span class="text-success">'+ string +'</span>';
                            } else {
                                string = Math.round(data.effort*100);
                                string = string + '%';
                                if (data.effort*100<100){
                                    content = '<span class="text-success">'+ string +'</span>'
                                } else if(100 <= data.effort*100 && data.effort*100<250) {
                                    content = '<span class="text-warning">'+ string +'</span>'
                                } else {
                                    content = '<span class="text-danger">'+ string +'</span>'
                                }
                            }
                            return content;
                        }
                    },
                    {
                        "targets": 4,
                        "render": function (data, type, row, meta) {
                            if (data.status.toLowerCase() === 'confirmed'){
                                content = '<span class="text-success">'+ data.status +'</span>'
                            } else if(data.status.toLowerCase() === 'pending') {
                                content = '<span class="text-warning">'+ data.status +'</span>'
                            } else {
                                content = '<span class="text-danger">'+ data.status +'</span>'
                            }
                            return content;
                        }
                    },
                    {
                        "targets": 6,
                        "render": function ( data, type, row, meta ) {
                            return '<div class="progress-container"> ' +
                                '<div class="progress"> ' +
                                '<div class="progress-bar" role="progressbar" ' +
                                'aria-valuenow="60" aria-valuemin="0" ' +
                                'aria-valuemax="100" ' +
                                'style="width: '+ (data.confirmationProgress)*100 +'%;"> ' +
                                '<span class="progress-value">'+ (data.confirmationProgress)*100 +'%</span> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div>';
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