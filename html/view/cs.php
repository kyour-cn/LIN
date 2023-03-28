<div class="container" id="vue-page">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    订单查询
                </div>
                <div class="panel-body">
                    <form id="searchForm" class="form-inline" role="form">
                        <input type="text" class="hidden">
                        <div class="form-group">
                            <select v-model="search.goodsid" class="form-control">
                                <option value="0">所有</option>
                                                                <option value="27789">社区QQ一号充值机器人</option>
                                                                <option value="150857">社区QQ三号充值机器人</option>
                                                                <option value="118095">平台微信三号充值机器人</option>
                                                                <option value="138777">平台微信四号扫码机器人</option>
                                                                <option value="22806">名片赞引流推广</option>
                                                                <option value="11053">永久情侣黄钻</option>
                                                                <option value="3570">爆刷名片赞-5分钟一万</option>
                                                                <option value="29197">飞快名片赞-日刷百万</option>
                                                                <option value="189561">超稳名片赞-日刷二十万</option>
                                                                <option value="2118">超速名片赞-日刷十万</option>
                                                                <option value="5210">凌晨名片赞-日刷十万</option>
                                                                <option value="4763">给力名片赞-日刷上万</option>
                                                                <option value="2946">低价名片赞-日刷几千</option>
                                                                <option value="2121">超速空间人气-日刷几百万</option>
                                                                <option value="10274">给力空间人气-日刷五十万</option>
                                                                <option value="2120">QQ个性标签赞-日刷十万</option>
                                                                <option value="2124">快刷空间说说赞-日刷百万</option>
                                                                <option value="2125">慢刷空间说说赞-日刷五万</option>
                                                                <option value="2126">慢刷空间说说浏览量-日刷几万</option>
                                                                <option value="199525">真人空间说说浏览量-日刷几万</option>
                                                                <option value="8683">独家空间人气-日刷五十万</option>
                                                                <option value="180069">电脑版空间主页赞</option>
                                                                <option value="10263">真人空间留言-日刷几千</option>
                                                                <option value="2128">全民K歌低级粉丝-日刷百万</option>
                                                                <option value="169240">全民K歌高级粉丝-日刷百万</option>
                                                                <option value="2132">全民K歌低级试听-日刷百万</option>
                                                                <option value="169294">全民K歌高级试听-日刷百万</option>
                                                                <option value="2129">全民K歌低级鲜花-日刷百万</option>
                                                                <option value="169307">全民K歌高级鲜花-日刷百万</option>
                                                                <option value="2130">全民K歌低级评论-日刷百万</option>
                                                                <option value="169239">全民K歌高级评论-日刷百万</option>
                                                                <option value="5119">全民K歌低级转发-日刷百万</option>
                                                                <option value="169308">全民K歌高级转发-日刷百万</option>
                                                                <option value="169318">全民K歌高级收录-日刷百万</option>
                                                                <option value="195908">全民K歌代刷经验-日刷上万</option>
                                                                <option value="2134">快手慢刷僵尸粉丝-日刷几百</option>
                                                                <option value="2135">快手播放-秒刷日刷百万</option>
                                                                <option value="2136">快手双击-秒刷日刷上万</option>
                                                                <option value="11064">快手作品评论-日刷上万</option>
                                                                <option value="11157">花椒粉丝-秒刷日刷百万</option>
                                                                <option value="15360">新浪微博僵尸粉丝</option>
                                                                <option value="27802">十位QQ单太阳-卡密发货</option>
                                                                <option value="134485">十位情侣QQ单太阳-卡密发货</option>
                                                                <option value="195873">十位QQ单太阳AAA型-卡密发货</option>
                                                                <option value="84415">十位QQ三十级-卡密发货</option>
                                                                <option value="27806">十位QQ双太阳-卡密发货</option>
                                                                <option value="144792">九位QQ低等级-卡密发货</option>
                                                                <option value="195885">九位QQ五级-卡密发货</option>
                                                                <option value="27797">九位QQ单太阳-卡密发货</option>
                                                                <option value="138323">九十位情侣QQ单太阳-卡密发货</option>
                                                                <option value="132706">九位二十级-卡密发货</option>
                                                                <option value="132704">九位QQ二十五级-卡密发货</option>
                                                                <option value="195881">九位QQ三十级-卡密发货</option>
                                                                <option value="27798">九位QQ双太阳-卡密发货</option>
                                                                <option value="84416">九位QQ四十级-卡密发货</option>
                                                                <option value="52755">八位QQ低等级AAA类型-卡密发货</option>
                                                                <option value="198611">七位QQ双太阳无4-卡密发货</option>
                                                                <option value="67877">十位YY单皇冠-卡密发货</option>
                                                                <option value="67876">十位YY双皇冠-卡密发货</option>
                                                                <option value="67875">九十位随机YY100级号</option>
                                                                <option value="67874">九位YY双皇冠号-卡密发货</option>
                                                                <option value="67873">八位YY低等级号-卡密发货</option>
                                                                <option value="67879">八位YY双皇冠号-卡密发货</option>
                                                                <option value="67878">八位YY三皇冠号-卡密发货</option>
                                                                <option value="67888">理论永久纯超级会员（全天急速秒单）</option>
                                                                <option value="18314">理论永久纯超级会员（48小时内勿催）</option>
                                                                <option value="5152">理论永久结合超级会员（48小时内勿催）</option>
                                                                <option value="5038">理论永久55会员（48小时内勿催）</option>
                                                                <option value="15771">理论永久hq会员（48小时内勿催）</option>
                                                                <option value="5149">理论永久黄钻（48小时内勿催）</option>
                                                                <option value="16094">理论豪华黄钻（48小时内勿催）</option>
                                                                <option value="5766">理论永久豪华绿（48小时内勿催）</option>
                                                                <option value="5151">理论永久好莱坞（48小时内勿催）</option>
                                                                <option value="5450">理论永久蓝钻（48小时内勿催）</option>
                                                                <option value="15725">Q币开通超级会员一月（24小时内到账）</option>
                                                                <option value="15730">Q币开通超级会员一年（24小时内到账）</option>
                                                                <option value="15744">Q币开通普通会员一月（24小时内到账）</option>
                                                                <option value="15749">Q币开通普通会员一年（24小时内到账）</option>
                                                                <option value="15742">Q币开通普通黄钻一月（24小时内到账）</option>
                                                                <option value="15743">Q币开通普通黄钻一年（24小时内到账）</option>
                                                                <option value="15735">Q币开通豪华绿一月（24小时内到账）</option>
                                                                <option value="69807">官方豪华黄钻（24小时内到账）</option>
                                                                <option value="67871">官方好莱坞一月</option>
                                                                <option value="17283">抖音慢刷僵尸粉丝</option>
                                                                <option value="173123">抖音快刷僵尸粉丝</option>
                                                                <option value="173124">抖音超级真人粉丝</option>
                                                                <option value="30950">抖音慢刷僵尸粉丝作品双击</option>
                                                                <option value="173133">抖音快刷僵尸粉丝作品双击</option>
                                                                <option value="173146">抖音超级真人僵尸粉丝双击</option>
                                                                <option value="17284">抖音视频刷作品播放</option>
                                                                <option value="90190">抖音视频刷作品分享</option>
                                                                <option value="17285">火山-小视频粉丝</option>
                                                                <option value="17286">火山-小视频双击</option>
                                                                <option value="17287">火山-小视频评论</option>
                                                                <option value="90157">火山-小视频分享</option>
                                                                <option value="129788">好莱坞会员5天-卡密发货</option>
                                                                <option value="34892">好莱坞会员30天-卡密发货</option>
                                                                <option value="28106">豪华绿钻+音乐包30天-卡密发货</option>
                                                                <option value="22123">爱奇艺黄金会员7天-卡密发货</option>
                                                                <option value="29260">爱奇艺黄金会员30天-卡密发货</option>
                                                                <option value="193475">芒果TV会员1天-卡密发货</option>
                                                                <option value="29461">芒果TV会员30天-卡密发货</option>
                                                                <option value="34906">乐视会员7天-卡密发货</option>
                                                                <option value="193479">搜狐会员1天-卡密发货</option>
                                                                <option value="193483">搜狐会员30天-卡密发货</option>
                                                                <option value="34913">优酷黄金会员14天-卡密发货</option>
                                                                <option value="193485">酷我音乐豪华VIP30天-卡密发货</option>
                                                                <option value="19825">王者荣耀随机物品-卡密发货</option>
                                                                <option value="67880">QQ飞车手游随机物品-卡密发货</option>
                                                                <option value="67883">荒野行动随机物品-卡密发货</option>
                                                                <option value="132567">绝地求生刺激战场手游高级CDK-卡密发货</option>
                                                                <option value="132683">绝地求生全军出击手游低级CDK-卡密发货</option>
                                                                <option value="132677">绝地求生全军出击手游高级CDK-卡密发货</option>
                                                                <option value="162619">微信东鹏特饮普通红包-卡密发货</option>
                                                                <option value="169983">微信东鹏特饮高级红包-卡密发货</option>
                                                                <option value="169984">微信百威红包</option>
                                                                <option value="179985">微信蒙牛FIFA（微信红包）-卡密发货</option>
                                                                <option value="28382">平台测试商品</option>
                                                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="search.column1" placeholder="下单内容">
                        </div>
                        <div class="form-group">
                            <select v-model="search.status" class="form-control load-data-input">
                                <option value="99">所有</option>
                                <option value="0">等待中</option>
                                <option value="1">进行中</option>
                                <option value="2">退单中</option>
                                <option value="3">已退单</option>
                                <option value="4">异常中</option>
                                <option value="5">补单中</option>
                                <option value="6">已更新</option>
                                <option value="90">已完成</option>
                                <option value="91">已退款</option>
                            </select>
                        </div>
                        <a class="btn btn-default purple" @click="search.page=1;loadRecordList();"><i
                                class="fa fa-search"></i> 查询</a>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>商品名称</th>
                                <th>Q Q</th>
                                <th>下单数量</th>
                                <th>已刷数量</th>
                                <th>初始数量</th>
                                <th>当前数量</th>
                                <th class="text-center">状态</th>
                                <th>下单时间</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
