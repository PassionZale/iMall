@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>控制台</h2>
            <small class="text-danger"><i>TODO:</i> 此模块暂为静态数据，数据渲染待开发。</small>
            <br>
            <small class="text-danger"><i>TODO:</i> 意见建议Table数据未来会对接商城的意见建议模块。</small>
        </div>
    </div>

    <div class="wrapper wrapper-content">

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>今日订单</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>笔</small></h1>
                        <small>成交金额：&yen;3000</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>昨日订单</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>笔</small></h1>
                        <small>成交金额：&yen;3000</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>本月订单</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>笔</small></h1>
                        <small>成交金额：&yen;3000</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>历史订单</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>笔</small></h1>
                        <small>成交金额：&yen;3000</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>新增用户</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>人</small></h1>
                        <small>采集最近7天数据</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>取消关注</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>人</small></h1>
                        <small>采集最近7天数据</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>净增用户数量</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>人</small></h1>
                        <small>新增用户 - 取消关注</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">more <i class="fa fa-angle-double-right"></i></span>
                        <h5>总用户量</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="text-danger">4000</span>&nbsp;<small>人</small></h1>
                        <small>采集最近7天数据</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="ibox">
            <div class="ibox-title">
                <h5>意见建议</h5>
            </div>
            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-1">
                        <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                    </div>
                    <div class="col-md-11">
                        <div class="input-group">
                            <input type="text" placeholder="Search" class="input-sm form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="project-list">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="label label-primary">2017-03-1 10:23:03</span>
                                </td>
                                <td class="project-title">
                                    <p>微信支付还未支持</p>
                                </td>
                                <td class="project-people">
                                    <a href="#">
                                        <img alt="image" class="img-circle" src="http://wx.qlogo.cn/mmopen/rySLVBqriaia7P42IobUZ4bqbjpGJ1PXvs1SRtF8mAGkLNGsKAmCxp9XoSgm1A1QPX7IWp8oTD83D0iaDeicKbv91QibvskIBXOtK/0">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-primary">2017-03-1 10:23:03</span>
                                </td>
                                <td class="project-title">
                                    <p>后台订单管理模块还未开发</p>
                                    <p>订单管理导航建议只保留一级导航，原二级导航改成订单的筛选条件</p>
                                </td>
                                <td class="project-people">
                                    <a href="#">
                                        <img alt="image" class="img-circle" src="http://wx.qlogo.cn/mmopen/rySLVBqriaia7P42IobUZ4bqbjpGJ1PXvs1SRtF8mAGkLNGsKAmCxp9XoSgm1A1QPX7IWp8oTD83D0iaDeicKbv91QibvskIBXOtK/0">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-primary">2017-03-1 10:23:03</span>
                                </td>
                                <td class="project-title">
                                    <p>后台订单管理模块还未开发</p>
                                    <p>订单管理导航建议只保留一级导航，原二级导航改成订单的筛选条件</p>
                                </td>
                                <td class="project-people">
                                    <a href="#">
                                        <img alt="image" class="img-circle" src="http://wx.qlogo.cn/mmopen/rySLVBqriaia7P42IobUZ4bqbjpGJ1PXvs1SRtF8mAGkLNGsKAmCxp9XoSgm1A1QPX7IWp8oTD83D0iaDeicKbv91QibvskIBXOtK/0">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-primary">2017-03-1 10:23:03</span>
                                </td>
                                <td class="project-title">
                                    <p>后台订单管理模块还未开发</p>
                                    <p>订单管理导航建议只保留一级导航，原二级导航改成订单的筛选条件</p>
                                </td>
                                <td class="project-people">
                                    <a href="#">
                                        <img alt="image" class="img-circle" src="http://wx.qlogo.cn/mmopen/rySLVBqriaia7P42IobUZ4bqbjpGJ1PXvs1SRtF8mAGkLNGsKAmCxp9XoSgm1A1QPX7IWp8oTD83D0iaDeicKbv91QibvskIBXOtK/0">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection