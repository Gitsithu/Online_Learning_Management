
<div class="container">

    <table id="exportTable" class="table table-hover">
        <thead>
            <tr>
                <th>User Name</th>
                <th style="width: 130px;">Course Name</th>
                <th>Bank Name</th>
                <th style="width: 130px;">Amount</th>
                <th >Image</th>
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
                                        
                <td style="width: 70px;">
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
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        name: { type: String },
                        title: { type: String },
                        bank_name: { type: String },
                        amount: { type: String },
                        image: { type: String },
                        status: { type: Integer },
                        created_at: { type: String }

                    }
                }
            });

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
                var pdf = new shield.exp.PDFDocument({
                    author: "PrepBootstrap",
                    created: new Date()
                });

                pdf.addPage("a4", "portrait");

                pdf.table(
                    70,
                    70,
                    data,
                    [
                        { field: "User Name", title: "User Name", width: 100 },
                        { field: "Course Name", title: "Course Name", width: 200 },
                        { field: "Bank Name", title: "Bank Name", width: 400 },
                        { field: "Amount", title: "Course Amount", width: 150 },
                        // { field: "Course Image", title: "Course Image", width: 100 },
                        { field: "Status", title: "Course Status", width: 50 },
                        { field: "Enroll Created", title: "Created", width: 100 }
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );

                pdf.saveAs({
                    fileName: "PrepBootstrapPDF"
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
