
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Monthly Recap Report</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Synchronize system</a></li>
                            <li><a href="#">Backup</a></li>
                            <li><a href="#">Export reports</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Set reminder</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">
                            <strong>visits so far</strong>
                        </p>

                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <div class="row">
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- ChartJS 1.0.1 -->
<!-- <script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{m_asset('core:js/dervis.min.js')}}"></script>