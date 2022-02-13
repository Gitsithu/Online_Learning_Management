<link rel="stylesheet" type="text/css" href="/Content/font-awesome/css/font-awesome.min.css" />

<div class="container">
    <button id="exportButton" class="btn btn-lg btn-danger clearfix"><span class="fa fa-file-excel-o"></span> Export to Excel</button>

    <table id="exportTable" class="table table-hover">
    <thead>
            <tr>
                <th>User Name</th>
                <th style="width: 130px;">Course Name</th>
                <th>Bank Name</th>
                <th style="width: 130px;">Amount</th>
                <!-- <th>Image</th> -->
                <th style="width: 80px;">Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrolls as $enroll)
            <?php $path = public_path(); ?>
            <tr>
                <td>{{$enroll->name}}</td>
                <td>{{$enroll->title}}</td>
                <td>{{$enroll->bank_name}}</td>
                <td>{{$enroll->amount}} -mmk</td>
                <td><img src="{{$path}}{{$enroll->image}}" width="40" height="40"></td>
                <td>
                @if($enroll->status == 2)
                <p class="text-success">Approved</p>
                @elseif($enroll->status == 1)
                <p class="text-secondary">Pending</p>
                @else
                <p class="text-danger">Rejected</p>
                @endif
                </td>
                <td>{{$enroll->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- you need to include the shieldui css and js assets in order for the components to work -->
<!-- <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script> -->

<script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Name: { type: String },
                        Age: { type: Number },
                        Email: { type: String }
                    }
                }
            });

            // when parsing is done, export the data to Excel
            dataSource.read().then(function (data) {
                new shield.exp.OOXMLWorkbook({
                    author: "PrepBootstrap",
                    worksheets: [
                        {
                            name: "PrepBootstrap Table",
                            rows: [
                                {
                                    cells: [
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Name"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Age"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Email"
                                        }
                                    ]
                                }
                            ].concat($.map(data, function(item) {
                                return {
                                    cells: [
                                        { type: String, value: item.Name },
                                        { type: Number, value: item.Age },
                                        { type: String, value: item.Email }
                                    ]
                                };
                            }))
                        }
                    ]
                }).saveAs({
                    fileName: "PrepBootstrapExcel"
                });
            });
        });
    });
</script>

<style>
    #exportButton {
        border-radius: 0;
    }
</style>
