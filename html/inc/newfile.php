<div class="row">
<div class="col-sm-7 col-xs-12">
<div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">商品在线下单</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="./pay/epay.php?xd" method="post">
                                    <blockquote>
                                          <p>独家观战</p>
                                          <footer>这里是观战分类的说明</footer>
                                    </blockquote>
                                    
                                    
                                    <div class="sub-title">请选择下单的商品 <span class="description">( <a href="javascript:alert('功能正在开发中！');">查看价格表</a> )</span></div>
                                        <select id="tid" name="tid" style="width:100%;" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                                            <option value="">请选择...</option>
                                            <!--optgroup label="球球观战50人">
                                                <option value="1">1小时</option>
                                                <option value="2">2小时</option>
                                                <option value="3">3小时</option>
                                                <option value="HI">5小时</option>
                                            </optgroup-->
<option value="22">5人观战1分钟</option><option value="gz100">观战100人</option>               
                                        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-tid-container"><span class="select2-selection__rendered" id="select2-tid-container" title="请选择...">请选择...</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <div class="sub-title">下单参数</div>
                                    <div id="xdinp">
                                    <input name="input" class="form-control" placeholder="请按说明正确填写" type="text">
                                    </div>
                                    
                                    <div id="numd"></div>
                                        
                                    <div class="sub-title">请选择支付方式</div>
                                    <div class="alert alert-success" role="alert">
                                        <strong>价格：<span id="tmoney">0.00</span>元</strong>
                                    </div>
                                        <div>
                                          <div class="radio3 radio-check radio-inline">
                                            <input id="radio7" name="type" value="yue" checked="" type="radio">
                                            <label for="radio7">
                                            余额
                                            </label>
                                          </div>
                                          <div class="radio3 radio-check radio-inline radio-inline">
                                            <input id="radio4" name="type" value="alipay" type="radio">
                                            <label for="radio4">
                                              支付宝
                                            </label>
                                          </div>
                                          <div class="radio3 radio-check radio-success radio-inline">
                                            <input id="radio5" name="type" value="wxpay" type="radio">
                                            <label for="radio5">
                                              微信
                                            </label>
                                          </div>
                                          <div class="radio3 radio-check radio-warning radio-inline">
                                            <input id="radio6" name="type" value="qqpay" type="radio">
                                            <label for="radio6">
                                              QQ
                                            </label>
                                          </div>
                                        </div>
                                    <button type="submit" class="btn btn-success">下单</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    <div class="title">商品说明</div>
                                    </div>
                                </div>
                                <div id="text" class="card-body">
                                    这个家伙很懒，什么都没有留下
                                </div>
                            </div>
                        </div>
                    </div>