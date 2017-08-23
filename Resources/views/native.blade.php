<?php
$orders = get_purchase_orders();
?>
@extends('layouts.app')
@section('content_title','Dashboard')
@section('content_description','Quick Overview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Synchronize system</a></li>
                            <li><a href="#">Backup</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong>Visits: 1 Jan, 2016 - 30 Jul, 2016</strong>
                        </p>

                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Goal Completion</strong>
                        </p>

                        <div class="progress-group">
                            <span class="progress-text">Add Products to Cart</span>
                            <span class="progress-number"><b>14</b>/200</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 7%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Complete Purchase</span>
                            <span class="progress-number"><b>310</b>/400</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Sent LPO's</span>
                            <span class="progress-number"><b>4</b>/40</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: 1%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Send Inquiries</span>
                            <span class="progress-number"><b>24</b>/130</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 20%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                            <h5 class="description-header">Ksh 35,210.43</h5>
                            <span class="description-text">Visits</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                            <h5 class="description-header">Ksh 10,390.90</h5>
                            <span class="description-text">Patients</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                            <h5 class="description-header">Ksh 24,813.53</h5>
                            <span class="description-text">TOTAL PROFIT</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                            <h5 class="description-header">1200</h5>
                            <span class="description-text">GOAL COMPLETION</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">My Calendar</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! $calendar->calendar() !!}
                {!! $calendar->script() !!}
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-4">
        <!-- PRODUCT LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Added Products</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">Paracetamol
                                <span class="label label-warning pull-right">Ksh 30</span></a>
                            <span class="product-description">
                                Added to store 1
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">Actal
                                <span class="label label-info pull-right">Ksh 100</span></a>
                            <span class="product-description">
                                40 packets only
                            </span>
                        </div>
                    </li>
                    <!-- /.item -->
                </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="{{route('inventory.products')}}" class="uppercase">View All Products</a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
</div>
<!-- ChartJS 1.0.1 -->
<script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{m_asset('core:js/dervis.min.js')}}"></script>
@stop